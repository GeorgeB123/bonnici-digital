<?php

namespace Drupal\dripyard_starterkit;

use Drupal\Core\Theme\StarterKitInterface;
use Symfony\Component\Yaml\Yaml;

final class StarterKit implements StarterKitInterface {

  /**
   * {@inheritdoc}
   */
  public static function postProcess(string $working_dir, string $machine_name, string $theme_name): void {
    // Get base theme information using centralized discovery
    $base_theme_name = $_ENV['DRIPYARD_BASE_THEME'] ?? NULL;
    $base_theme_info = self::findBaseThemeInfo($base_theme_name);

    $base_theme = $base_theme_info['name'];
    $base_theme_info_file = $base_theme_info['path'];
    $base_theme_regions = $base_theme_info['regions'];

    // Update the generated theme's info file
    $info_file = "$working_dir/$machine_name.info.yml";
    if (file_exists($info_file)) {
      $content = file_get_contents($info_file);

      // Replace the base theme
      $content = str_replace("'base theme': dripyard_base", "'base theme': $base_theme", $content);

      // Remove starterkit: true line
      $content = preg_replace('/^starterkit:\s*true\s*$/m', '', $content);
      // Clean up any double newlines that might result
      $content = preg_replace('/\n\n+/', "\n\n", $content);

      // Add template comments before regions
      $content .= self::getInfoYmlComments();

      // Add regions from base theme if they don't already exist
      if (!empty($base_theme_regions) && !preg_match('/^regions:\s*$/m', $content)) {
        // Add regions section at the end
        $regions_yaml = "\nregions:\n";
        foreach ($base_theme_regions as $key => $label) {
          $regions_yaml .= "  $key: $label\n";
        }
        $content .= $regions_yaml;
      }

      file_put_contents($info_file, $content);
    }

    // Copy logo.svg from base theme if it exists
    if ($base_theme_info_file) {
      $base_theme_dir = dirname($base_theme_info_file);
      $base_logo_path = "$base_theme_dir/logo.svg";
      $new_logo_path = "$working_dir/logo.svg";

      if (file_exists($base_logo_path) && !file_exists($new_logo_path)) {
        copy($base_logo_path, $new_logo_path);
      }
    }

    // Copy and process config from base theme
    self::copyBaseThemeConfig($working_dir, $machine_name, $base_theme, $base_theme_info_file);

    // Process all theme files to replace placeholders
    self::processThemeFiles($working_dir, $machine_name, $theme_name, $base_theme);
  }

  /**
   * Copy and process config from base theme.
   *
   * @param string $working_dir
   *   The working directory path.
   * @param string $machine_name
   *   The machine name of the new theme.
   * @param string $base_theme
   *   The base theme name.
   * @param string $base_theme_info_file
   *   The path to the base theme's info file.
   */
  private static function copyBaseThemeConfig(string $working_dir, string $machine_name, string $base_theme, string $base_theme_info_file): void {
    if (!$base_theme_info_file) {
      return;
    }

    $base_theme_dir = dirname($base_theme_info_file);
    $base_config_dir = "$base_theme_dir/config";
    $new_config_dir = "$working_dir/config";

    // Check if base theme has a config directory
    if (!is_dir($base_config_dir)) {
      return;
    }

    // Create config directory in new theme
    if (!is_dir($new_config_dir)) {
      mkdir($new_config_dir, 0755, TRUE);
    }

    // Copy all config files recursively
    $iterator = new \RecursiveIteratorIterator(
      new \RecursiveDirectoryIterator($base_config_dir, \RecursiveDirectoryIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
      if ($file->isFile()) {
        $relative_path = str_replace($base_config_dir . DIRECTORY_SEPARATOR, '', $file->getPathname());
        $new_file_path = $new_config_dir . DIRECTORY_SEPARATOR . $relative_path;

        // Create subdirectories if needed
        $new_dir = dirname($new_file_path);
        if (!is_dir($new_dir)) {
          mkdir($new_dir, 0755, TRUE);
        }

        // Copy file and process content
        $content = file_get_contents($file->getPathname());

        // Replace theme references in content
        $content = str_replace($base_theme, $machine_name, $content);

        // Replace theme references in filename
        $new_filename = str_replace($base_theme, $machine_name, basename($new_file_path));
        $final_path = dirname($new_file_path) . DIRECTORY_SEPARATOR . $new_filename;

        file_put_contents($final_path, $content);
      }
    }
  }

  /**
   * Get the info.yml comments from the template.
   *
   * @return string
   *   The comments section to append to the info.yml file.
   */
  private static function getInfoYmlComments(): string {
    return "
#
# Libraries extend will add custom libraries to specified libraries
# @see https://www.drupal.org/docs/develop/theming-drupal/adding-assets-css-js-to-a-drupal-theme-via-librariesyml
#

# libraries-extend:

# In this, case we extend dripyard_base's user-login-form library with
# our own of the same name.

#   dripyard_base/user-login-form:
#     - testtheme/user-login-form

# Here we extend dripyard_base's status-message SDC library with our own.

#  core/components.dripyard_base--status-messages:
#    - testtheme/status-messages
";
  }

  /**
   * Find base theme information.
   *
   * @param string|null $base_theme_name
   *   Optional base theme name. If not provided, will auto-discover.
   *
   * @return array<string, mixed>
   *   Array with 'name', 'path', and 'regions' keys.
   */
  private static function findBaseThemeInfo(?string $base_theme_name = NULL): array {
    $result = [
      'name' => NULL,
      'path' => NULL,
      'regions' => [],
    ];

    // Glob for all info.yml files up to 3 levels deep
    $info_files = glob(DRUPAL_ROOT . '/themes/*/*.info.yml') ?: [];
    $info_files = array_merge($info_files, glob(DRUPAL_ROOT . '/themes/*/*/*.info.yml') ?: []);
    $info_files = array_merge($info_files, glob(DRUPAL_ROOT . '/themes/*/*/*/*.info.yml') ?: []);

    foreach ($info_files as $info_file) {
      if (!file_exists($info_file)) {
        continue;
      }

      $content = file_get_contents($info_file);
      $theme_name = basename(dirname($info_file));

      // If we have a specific theme name, only process that theme
      if ($base_theme_name && $theme_name !== $base_theme_name) {
        continue;
      }

      // If we don't have a theme name, find first theme with dripyard_base as base
      if (!$base_theme_name) {
        if (!preg_match('/^(?:\'base theme\'|base theme):\s*[\'"]?dripyard_base[\'"]?\s*$/m', $content)) {
          // This theme doesn't extend dripyard_base
          continue;
        }
      }

      // We found our theme - extract info
      $result['name'] = $theme_name;
      $result['path'] = $info_file;
      // Parse YAML to extract regions using Symfony YAML component
      try {
        $theme_data = Yaml::parse($content);
        if (isset($theme_data['regions'])) {
          $result['regions'] = $theme_data['regions'];
        }
      }
      catch (\Exception) {
        // Simple regex parsing for regions if YAML parsing fails
        if (preg_match('/regions:\s*\n((?:\s+\w+:.*\n?)*)/m', $content, $matches)) {
          $regions_section = $matches[1];
          if (preg_match_all('/^\s+(\w+):\s*(.*)$/m', $regions_section, $region_matches, PREG_SET_ORDER)) {
            foreach ($region_matches as $match) {
              $result['regions'][$match[1]] = trim($match[2], '"\'');
            }
          }
        }
      }
      // Found our theme, exit the loop
      break;
    }

    // Final fallback if nothing found
    if (!$result['name']) {
      $result['name'] = 'neonbyte';
    }

    return $result;
  }

  /**
   * Convert snake_case to PascalCase.
   *
   * @param string $snake_case
   *   The snake_case string to convert.
   *
   * @return string
   *   The PascalCase string.
   */
  private static function toPascalCase(string $snake_case): string {
    return str_replace('_', '', ucwords($snake_case, '_'));
  }

  /**
   * Process theme files to replace placeholders.
   *
   * @param string $working_dir
   *   The working directory path.
   * @param string $machine_name
   *   The machine name of the theme.
   * @param string $theme_name
   *   The human-readable theme name.
   * @param string $base_theme
   *   The base theme name.
   */
  private static function processThemeFiles(string $working_dir, string $machine_name, string $theme_name, string $base_theme): void {
    $pascal_case_name = self::toPascalCase($machine_name);
    $upper_case_name = strtoupper($machine_name);

    // Define replacements
    $replacements = [
      'DRIPYARD_STARTERKIT' => $upper_case_name,
      'dripyard_starterkit' => $machine_name,
      'DripyardStarterkit' => $pascal_case_name,
      'THEMENAME' => $machine_name,
      'BASETHEME' => $base_theme,
      'DRIPYARD_BASE_THEME' => $base_theme,
    ];

    // Process all files recursively
    $iterator = new \RecursiveIteratorIterator(
      new \RecursiveDirectoryIterator($working_dir, \RecursiveDirectoryIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
      if ($file->isFile() && !in_array($file->getExtension(), ['png', 'jpg', 'jpeg', 'gif', 'svg', 'ico'])) {
        $content = file_get_contents($file->getPathname());
        $updated_content = str_replace(array_keys($replacements), array_values($replacements), $content);

        if ($content !== $updated_content) {
          file_put_contents($file->getPathname(), $updated_content);
        }
      }
    }
  }

}
