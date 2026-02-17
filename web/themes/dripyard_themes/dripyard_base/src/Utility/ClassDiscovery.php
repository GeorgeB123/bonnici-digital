<?php

namespace Drupal\dripyard_base\Utility;

/**
 * Utility class for discovering and loading theme classes dynamically.
 */
class ClassDiscovery {

  /**
   * Static cache for theme inheritance paths.
   *
   * @var array<string, array<string, string>>
   */
  protected static $themeInheritanceCache = [];

  /**
   * Resolves the theme inheritance tree for a given theme.
   *
   * @param string $theme_name
   *   The machine name of the theme.
   *
   * @return array<string, string>
   *   An associative array of theme names to their paths, ordered from
   *   the given theme to dripyard_base. For example:
   */
  public static function resolveThemeInheritance(string $theme_name): array {
    // Return from cache if already resolved.
    if (isset(self::$themeInheritanceCache[$theme_name])) {
      return self::$themeInheritanceCache[$theme_name];
    }

    $inheritance = [];
    $theme_handler = \Drupal::service('theme_handler');
    $current_theme = $theme_name;

    // Walk up the inheritance tree until we reach dripyard_base or have no base theme.
    while ($current_theme) {
      try {
        $theme_info = $theme_handler->getTheme($current_theme);
        $theme_path = $theme_info->getPath();
        $inheritance[$current_theme] = $theme_path;

        // Check if we've reached dripyard_base or if there's no base theme.
        if ($current_theme === 'dripyard_base' || empty($theme_info->base_theme)) {
          break;
        }

        // Move to the parent theme.
        $current_theme = $theme_info->base_theme;
      }
      catch (\Exception) {
        // If we can't load the theme, stop the inheritance chain.
        break;
      }
    }

    // Cache the result.
    self::$themeInheritanceCache[$theme_name] = $inheritance;

    return $inheritance;
  }

  /**
   * Discovers all PHP classes in a directory.
   *
   * @param string $directory
   *   The directory path to scan for PHP files.
   *
   * @return array<int, string>
   *   Array of class names (without namespace) found in the directory.
   */
  public static function discoverClassesInDirectory(string $directory): array {
    $classes = [];

    if (!is_dir($directory)) {
      return $classes;
    }

    $files = glob($directory . '/*.php');

    foreach ($files as $file) {
      $filename = basename($file, '.php');
      // Skip files that don't look like class names (should start with uppercase).
      if (ctype_upper($filename[0])) {
        $classes[] = $filename;
      }
    }

    return $classes;
  }

  /**
   * Gets all available concrete (non-abstract) classes for a specific namespace path in a theme.
   *
   * @param string $theme_name
   *   The theme name.
   * @param string $namespace_path
   *   The namespace path (e.g., 'ThemeSettings', 'Preprocess/Page').
   * @param bool $sort_by_weight
   *   Whether to sort classes by weight. Defaults to TRUE.
   *
   * @return array<int, string>
   *   Array of unique concrete class names available in theme and all parent themes,
   *   optionally sorted by weight.
   */
  public static function getAvailableClasses(string $theme_name, string $namespace_path, bool $sort_by_weight = TRUE): array {
    $classes = [];

    // Get the theme inheritance tree.
    $inheritance = self::resolveThemeInheritance($theme_name);

    // Discover classes in each theme in the inheritance tree.
    foreach ($inheritance as $theme_path) {
      $theme_dir = DRUPAL_ROOT . '/' . $theme_path . '/src/' . $namespace_path;
      $theme_classes = self::discoverClassesInDirectory($theme_dir);
      $classes = array_merge($classes, $theme_classes);
    }

    // Get unique classes and filter out abstract ones.
    $unique_classes = array_unique($classes);
    $concrete_classes = self::filterAbstractClasses($unique_classes, $theme_name, str_replace('/', '\\', $namespace_path));

    // Sort by weight if requested.
    if ($sort_by_weight) {
      $concrete_classes = self::sortClassesByWeight($concrete_classes, $theme_name, str_replace('/', '\\', $namespace_path));
    }

    return $concrete_classes;
  }

  /**
   * Attempts to load a class from the theme inheritance tree.
   *
   * @param string $theme_name
   *   The theme name.
   * @param string $namespace_path
   *   The namespace path (e.g., 'ThemeSettings', 'Preprocess\\Page').
   * @param string $class_name
   *   The class name.
   *
   * @return string|null
   *   The fully qualified class name if found, null otherwise.
   */
  public static function loadClass(string $theme_name, string $namespace_path, string $class_name): ?string {
    // Get the theme inheritance tree.
    $inheritance = self::resolveThemeInheritance($theme_name);

    // Try each theme in the inheritance tree, starting with the most specific.
    foreach ($inheritance as $theme => $theme_path) {
      $full_class = "Drupal\\{$theme}\\{$namespace_path}\\{$class_name}";
      if (@class_exists($full_class)) {
        return $full_class;
      }
    }

    return NULL;
  }

  /**
   * Filters out abstract classes from a list of class names.
   *
   * @param array<int, string> $class_names
   *   Array of class names to filter.
   * @param string $theme_name
   *   The theme name.
   * @param string $namespace_path
   *   The namespace path.
   *
   * @return array<int, string>
   *   Array of non-abstract class names.
   */
  public static function filterAbstractClasses(array $class_names, string $theme_name, string $namespace_path): array {
    $concrete_classes = [];

    foreach ($class_names as $class_name) {
      $full_class_name = self::loadClass($theme_name, $namespace_path, $class_name);
      if ($full_class_name !== NULL) {
        $reflection = new \ReflectionClass($full_class_name);
        if (!$reflection->isAbstract()) {
          $concrete_classes[] = $class_name;
        }
      }
    }

    return $concrete_classes;
  }

  /**
   * Sorts classes by their weight property.
   *
   * @param array<int, string> $class_names
   *   Array of class names to sort.
   * @param string $theme_name
   *   The theme name.
   * @param string $namespace_path
   *   The namespace path.
   *
   * @return array<int, string>
   *   Array of class names sorted by weight (lowest first).
   */
  public static function sortClassesByWeight(array $class_names, string $theme_name, string $namespace_path): array {
    $weighted_classes = [];

    foreach ($class_names as $class_name) {
      $full_class_name = self::loadClass($theme_name, $namespace_path, $class_name);
      if ($full_class_name !== NULL) {
        $weight = self::getClassWeight($full_class_name);
        $weighted_classes[] = [
          'class_name' => $class_name,
          'weight' => $weight,
        ];
      }
    }

    // Sort by weight (lowest first).
    usort($weighted_classes, function ($a, $b) {
      return $a['weight'] <=> $b['weight'];
    });

    // Extract just the class names.
    return array_column($weighted_classes, 'class_name');
  }

  /**
   * Gets the weight of a class.
   *
   * @param string $full_class_name
   *   The fully qualified class name.
   *
   * @return int
   *   The weight of the class. Defaults to 0 if no weight is defined.
   */
  public static function getClassWeight(string $full_class_name): int {
    $reflection = new \ReflectionClass($full_class_name);

    // Check for weight property.
    if ($reflection->hasProperty('weight')) {
      $weight_property = $reflection->getProperty('weight');
      if ($weight_property->isStatic()) {
        return $weight_property->getValue();
      }
    }

    // Check for getWeight method.
    if ($reflection->hasMethod('getWeight')) {
      $weight_method = $reflection->getMethod('getWeight');
      if ($weight_method->isStatic()) {
        return $weight_method->invoke(NULL);
      }
    }

    // Default weight.
    return 1000;
  }

}
