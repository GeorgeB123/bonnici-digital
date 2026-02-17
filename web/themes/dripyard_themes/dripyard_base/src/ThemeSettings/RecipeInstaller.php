<?php

namespace Drupal\dripyard_base\ThemeSettings;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\Url;
use Drupal\dripyard_base\Recipes\RecipeBatchProcessor;

/**
 * Installer for recipes.
 *
 * Handles theme settings form integration for recipe installation.
 */
class RecipeInstaller extends ThemeSettingsBase {

  /**
   * Check if Drupal CMS is installed.
   *
   * @return bool
   *   TRUE if Drupal CMS is installed, FALSE otherwise.
   */
  protected function isCmsInstalled(): bool {
    return \Drupal::moduleHandler()->moduleExists('drupal_cms_helper');
  }

  /**
   * Transform recipe machine name for CMS compatibility.
   *
   * Canvas patterns recipes have different component version hashes between
   * Drupal Core and Drupal CMS due to the additional svg_image media type
   * in CMS. This method adjusts the recipe machine_name to use the CMS
   * variant when CMS is detected.
   *
   * @param string $machine_name
   *   The original recipe machine name.
   *
   * @return string
   *   The transformed machine name (with _cms suffix if needed).
   */
  protected function transformRecipeForCms(string $machine_name): string {
    return static::transformRecipeForCmsStatic($machine_name);
  }

  /**
   * Static version of transformRecipeForCms for use in static context.
   *
   * @param string $machine_name
   *   The original recipe machine name.
   *
   * @return string
   *   The transformed machine name (with _cms suffix if needed).
   */
  protected static function transformRecipeForCmsStatic(string $machine_name): string {
    if (!\Drupal::moduleHandler()->moduleExists('drupal_cms_helper')) {
      return $machine_name;
    }

    // Canvas patterns recipes need CMS variants due to different
    // component version hashes (svg_image media type in CMS)
    $cms_pattern_recipes = [
      'dripyard_canvas_patterns',
      'dripyard_neonbyte_canvas_patterns',
      'dripyard_meridian_canvas_patterns',
      'dripyard_greatlakes_canvas_patterns',
    ];

    if (in_array($machine_name, $cms_pattern_recipes, TRUE)) {
      return $machine_name . '_cms';
    }

    return $machine_name;
  }

  /**
   * Theme settings form alter to show recipe install options.
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function themeSettingsFormAlter(array &$form, FormStateInterface $form_state): void {
    parent::themeSettingsFormAlter($form, $form_state);
    $form['apply_recipes'] = [
      '#type' => 'details',
      '#title' => t('Apply Recipes'),
      '#open' => FALSE,
      '#tree' => TRUE,
      '#weight' => 10,
      '#description' => t('You can quick start your site building experience by enabling the recipes below. These recipes will create configurations and optional demo content on your site so you can see the power of a Dripyard theme!'),
    ];
    foreach ($this->getAvailableRecipes() as $recipe => $recipe_info) {
      $form['apply_recipes'][$recipe] = [
        '#type' => 'checkbox',
        '#title' => $recipe_info['title'],
        '#description' => $recipe_info['description'],
        '#default_value' => FALSE,
      ];

      // Check for module dependencies
      $dependency_message = $this->checkRecipeDependencies($recipe_info);
      if (!empty($dependency_message)) {
        $form['apply_recipes'][$recipe]['#disabled'] = TRUE;
        $form['apply_recipes'][$recipe]['#description'] = Markup::create($recipe_info['description'] . $dependency_message);
      }

      if (!empty($recipe_info['extended_by']) && empty($dependency_message)) {
        foreach ($recipe_info['extended_by'] as $extended_recipe) {
          $form['apply_recipes'][$recipe]['#states']['checked'][] = [
            'input[name="apply_recipes[' . $extended_recipe . ']"]' => ['checked' => TRUE],
          ];
          $form['apply_recipes'][$recipe]['#states']['disabled'][] = [
            'input[name="apply_recipes[' . $extended_recipe . ']"]' => ['checked' => TRUE],
          ];
        }
      }
    }

    $form['apply_recipes']['notice'] = [
      '#type' => 'item',
      '#markup' => t('<em>Note: Drupal does not track recipe installation status, so this interface will not be updated to show that recipes have been installed. Recipes can be reran, but manual changes to items defined in the recipes will not be reverted.</em>'),
    ];

    $form['#submit'][] = [self::class, 'themeSettingsSubmit'];
  }

  /**
   * Submit callback to install selected recipes.
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public static function themeSettingsSubmit(array $form, FormStateInterface $form_state): void {
    $theme = $form_state->get('theme_name');
    $recipes = $form_state->getValue('apply_recipes');
    $queued = [];

    // Collect selected recipes, separating canvas_patterns for last.
    $selected = [];
    $patterns_recipe = NULL;
    foreach ($recipes as $recipe => $value) {
      if (empty($value)) {
        continue;
      }
      // If canvas_demo is selected, also install canvas_patterns.
      // Form #states shows it checked but doesn't submit the value.
      // We can't make it a hard dependency because of CMS variant detection.
      if (str_contains($recipe, '_canvas_demo')) {
        $patterns_recipe = str_replace('_canvas_demo', '_canvas_patterns', $recipe);
      }
      if (str_contains($recipe, '_canvas_patterns')) {
        $patterns_recipe = $recipe;
      }
      else {
        $selected[] = $recipe;
      }
    }

    // Queue selected recipes, then patterns last.
    foreach ($selected as $recipe) {
      $recipe = static::transformRecipeForCmsStatic($recipe);
      RecipeBatchProcessor::queueInstall($recipe, $theme);
      $queued[] = $recipe;
    }
    if ($patterns_recipe) {
      $patterns_recipe = static::transformRecipeForCmsStatic($patterns_recipe);
      RecipeBatchProcessor::queueInstall($patterns_recipe, $theme);
      $queued[] = $patterns_recipe;
    }

    if (!empty($queued)) {
      try {
        RecipeBatchProcessor::install();
      }
      catch (\Exception $e) {
        \Drupal::messenger()->addError(t('An error occurred while installing the recipes: @message', ['@message' => $e->getMessage()]));
        return;
      }
      \Drupal::messenger()->addStatus(t('The selected recipes were successfully installed.'));
    }
  }

  /**
   * Returns the available recipes.
   *
   * @return array<string, array<string, mixed>>
   *   The recipes.
   */
  protected function getAvailableRecipes(): array {
    return [];
  }

  /**
   * Check recipe dependencies and return formatted message.
   *
   * @param array<string, mixed> $recipe_info
   *   The recipe information array.
   *
   * @return string
   *   Formatted HTML message, or empty string if no missing dependencies.
   */
  private function checkRecipeDependencies(array $recipe_info): string {
    if (empty($recipe_info['dependencies'])) {
      return '';
    }

    $moduleHandler = \Drupal::service('module_handler');
    $moduleExtensionList = \Drupal::service('extension.list.module');
    $needs_enabling = [];
    $needs_download = [];

    foreach ($recipe_info['dependencies'] as $module) {
      if (!$moduleHandler->moduleExists($module)) {
        // Check if module is installed but not enabled
        if ($moduleExtensionList->exists($module)) {
          $needs_enabling[] = $module;
        }
        else {
          $needs_download[] = $module;
        }
      }
    }

    // Return empty string if no missing dependencies
    if (empty($needs_enabling) && empty($needs_download)) {
      return '';
    }

    $message_parts = [];

    if (!empty($needs_enabling)) {
      $modules_url = Url::fromRoute('system.modules_list')->toString();
      $module_links = array_map(function ($module) use ($modules_url) {
        return '<a href="' . $modules_url . '" target="_blank">' . htmlspecialchars($module, ENT_QUOTES, 'UTF-8') . '</a>';
      }, $needs_enabling);
      $message_parts[] = t('Enable these modules: @modules', [
        '@modules' => Markup::create(implode(', ', $module_links)),
      ]);
    }

    if (!empty($needs_download)) {
      $module_links = array_map(function ($module) {
        return '<a href="https://www.drupal.org/project/' . htmlspecialchars($module, ENT_QUOTES, 'UTF-8') . '" target="_blank">' . htmlspecialchars($module, ENT_QUOTES, 'UTF-8') . '</a>';
      }, $needs_download);
      $message_parts[] = t('Download and install these modules: @modules', [
        '@modules' => Markup::create(implode(', ', $module_links)),
      ]);
    }

    return '<br><strong>' . implode(' ', $message_parts) . '</strong>';
  }

}
