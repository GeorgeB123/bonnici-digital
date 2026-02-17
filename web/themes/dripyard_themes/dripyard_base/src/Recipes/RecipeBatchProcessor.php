<?php

namespace Drupal\dripyard_base\Recipes;

use Drupal\Core\Batch\BatchBuilder;
use Drupal\Core\Recipe\Recipe;
use Drupal\Core\Recipe\RecipeRunner;
use Drupal\dripyard_base\Utility\ClassDiscovery;

/**
 * Handles batch processing and installation of recipes.
 */
class RecipeBatchProcessor {

  /**
   * Static variable to hold the batch builder.
   *
   * @var \Drupal\Core\Batch\BatchBuilder|null
   *   The batch builder instance.
   */
  public static $recipeBatch = NULL;

  /**
   * Queues a recipe to be installed.
   *
   * @param string $recipe_key
   *   The path to the recipe directory.
   * @param string $theme
   *   The theme name.
   *
   * @return bool
   *   TRUE if the recipe was installed successfully, FALSE otherwise.
   */
  public static function queueInstall($recipe_key, $theme) {
    try {
      $recipe_path = static::resolveRecipePath($recipe_key, $theme);
      $recipe = Recipe::createFromDirectory($recipe_path);
      static::$recipeBatch = static::$recipeBatch ?? new BatchBuilder();

      // Ensure this file is loaded on every operation since themes
      // do not have automatic class loading.
      static::$recipeBatch->setFile(\Drupal::service('extension.list.theme')->getPath('dripyard_base') . '/src/Recipes/RecipeBatchProcessor.php');

      $operations = RecipeRunner::toBatchOperations($recipe);
      foreach ($operations as $operation) {
        // Wrap each of the recipe operations with our custom wrapper to control
        // class loading and error handling.
        $wrapper = [
          static::class,
          'recipeRunnerWrapper',
        ];
        $args = [
          $operation[0][1],
          $operation[1],
        ];
        static::$recipeBatch->addOperation($wrapper, $args);
      }

    }
    catch (\Exception $ex) {
      \Drupal::messenger()->addError(t('The recipe installation was unsuccessful due to an error: @error', ['@error' => $ex->getMessage()]));
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Installs all queued recipes.
   */
  public static function install(): void {
    // Ensure that the discover cache is cleared before running the batch.
    // Otherwise, we'll end up errors about layouts not being found on occasion.
    \Drupal::cache('discovery')->deleteAll();

    if (static::$recipeBatch === NULL) {
      throw new \Exception('No recipes have been queued for installation.');
    }

    batch_set(static::$recipeBatch->toArray());
  }

  /**
   * Recipe wrapper to control includes and error handling.
   *
   * @param string $callback
   *   The original function name.
   * @param array<string, mixed> $args
   *   The args to pass.
   * @param array<string, mixed> $context
   *   The context array.
   */
  public static function recipeRunnerWrapper(string $callback, array $args, ?array &$context = NULL): void {
    require_once __DIR__ . '/../../dripyard-classloader.php';
    $args[] = &$context;
    try {
      if (\is_callable([RecipeRunner::class, $callback])) {
        call_user_func([RecipeRunner::class, $callback], ...$args);
      }
    }
    catch (\Exception $ex) {
      \Drupal::messenger()->addError(t('The recipe installation was unsuccessful failed due to an error: @error', ['@error' => $ex->getMessage()]));
    }
  }

  /**
   * Resolves the path to the recipes by traversing the theme inheritance tree.
   *
   * @param string $recipe_path
   *   The relative path to the recipe.
   * @param string $theme
   *   The theme name.
   *
   * @return string
   *   The filesystem path to the recipe.
   *
   * @throws \InvalidArgumentException
   *   If the theme does not exist.
   * @throws \RuntimeException
   *   If the recipe cannot be found in any theme in the inheritance tree.
   */
  protected static function resolveRecipePath($recipe_path, $theme) {
    // Get the theme inheritance tree.
    $inheritance = ClassDiscovery::resolveThemeInheritance($theme);

    if (empty($inheritance)) {
      throw new \InvalidArgumentException('The theme "' . $theme . '" does not exist.');
    }

    // Try to find the recipe in each theme, starting with the most specific.
    foreach ($inheritance as $theme_path) {
      $full_recipe_path = DRUPAL_ROOT . '/' . $theme_path . '/recipes/' . $recipe_path;

      // Check if the recipe directory exists.
      if (is_dir($full_recipe_path)) {
        return $full_recipe_path;
      }
    }

    // If we get here, the recipe was not found in any theme.
    throw new \RuntimeException(sprintf(
      'Recipe "%s" not found in theme "%s" or any of its parent themes.',
      $recipe_path,
      $theme
    ));
  }

}
