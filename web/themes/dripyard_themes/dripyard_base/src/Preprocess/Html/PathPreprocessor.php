<?php

namespace Drupal\dripyard_base\Preprocess\Html;

use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocesses HTML elements to add fonts.
 */
class PathPreprocessor extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function applies($variables): bool {
    // This preprocessor applies to HTML templates.
    return isset($variables['html_attributes']);
  }

  /**
   * {@inheritdoc}
   */
  public function preprocess(&$variables): void {
    $variables = array_merge($variables, $this->discoverPaths());
  }

  /**
   * Resolve the paths for Dripyard's inherited themes.
   *
   * @return array<string, mixed>
   *   The theme paths of base and primary themes.
   */
  protected function discoverPaths(): array {
    $active_theme = \Drupal::theme()->getActiveTheme();
    $paths = [];
    foreach ($active_theme->getBaseThemeExtensions() as $theme) {
      if (!empty($theme->info['dripyard_theme_level'])) {
        $key = 'dripyard_' . $theme->info['dripyard_theme_level'] . '_path';
        $paths[$key] = \Drupal::request()->getBasePath() . '/' . $theme->getPath();
      }
    }
    return $paths;
  }

}
