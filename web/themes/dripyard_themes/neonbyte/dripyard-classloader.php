<?php

/**
 * @file
 * Optimized autoloader for the Neonbyte theme.
 *
 * This file implements PSR-4 autoloading for theme classes.
 * It follows the same optimization patterns as the base theme.
 *
 * @see https://www.php-fig.org/psr/psr-4/
 */

namespace {
  // Check if this autoloader has already been registered to avoid duplicates.
  if (!defined('DRIPYARD_NEONBYTE_AUTOLOADER_LOADED')) {
    define('DRIPYARD_NEONBYTE_AUTOLOADER_LOADED', TRUE);

    /**
     * Register the Neonbyte autoloader.
     */
    spl_autoload_register(function ($class) {
      $prefix = 'Drupal\\neonbyte\\';
      $base_dir = __DIR__ . '/src/';
      $len = strlen($prefix);

      // Check if the class uses the namespace prefix.
      if (strncmp($prefix, $class, $len) !== 0) {
        return;
      }

      // Get the relative class name.
      $relative_class = substr($class, $len);

      // Replace namespace separators with directory separators and append .php
      $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

      // If the file exists, require it.
      if (file_exists($file)) {
        require $file;
      }
    });
  }
}
