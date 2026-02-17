<?php

/**
 * @file
 * Optimized autoloader for the Dripyard Base themes.
 *
 * This file implements PSR-4 autoloading for theme classes and provides
 * an efficient mechanism for loading dependent theme autoloaders when
 * they aren't resolved by composer autoloading.
 */

namespace {
  if (!defined('DRIPYARD_BASE_AUTOLOADER_LOADED')) {
    define('DRIPYARD_BASE_AUTOLOADER_LOADED', TRUE);

    spl_autoload_register(function ($class) {
      $prefix = 'Drupal\\dripyard_base\\';
      $base_dir = __DIR__ . '/src/';
      $len = strlen($prefix);

      if (strncmp($prefix, $class, $len) !== 0) {
        return;
      }

      $relative_class = substr($class, $len);

      $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

      if (file_exists($file)) {
        require $file;
      }
    });

    /**
     * Load dependent theme autoloaders efficiently.
     *
     * This function discovers and loads autoloaders from all installed themes
     * using Drupal's theme handler when available. The static variable ensures
     * this only runs once per request.
     */
    function dripyard_load_theme_autoloaders(): void {
      static $loaded = FALSE;
      if ($loaded) {
        return;
      }
      $loaded = TRUE;

      // Use Drupal's theme handler for efficient discovery when available.
      if (class_exists('\\Drupal', FALSE) && \Drupal::hasService('theme_handler')) {
        try {
          $themes = \Drupal::service('theme_handler')->listInfo();
          foreach ($themes as $theme) {
            // Skip the base theme.
            if ($theme->getName() === 'dripyard_base') {
              continue;
            }
            $autoloader_path = DRUPAL_ROOT . '/' . $theme->getPath() . '/dripyard-classloader.php';
            if (file_exists($autoloader_path) && $autoloader_path !== __FILE__) {
              require_once $autoloader_path;
            }
          }
        }
        catch (\Exception) {
          // If theme handler fails, silently continue.
          // The autoloaders can still be loaded individually when needed.
        }
      }
    }

    // Load theme autoloaders.
    dripyard_load_theme_autoloaders();
  }
}
