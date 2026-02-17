<?php

namespace Drupal\neonbyte\Preprocess\Html;

use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocesses HTML elements to add theme colors.
 */
class ThemeSettingsPreprocessor extends PreprocessBase {

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
    $header_settings = \Drupal::config($this->getTheme() . '.settings')->get('header_settings')
      ?? [
        'full_width' => FALSE,
        'remove_sticky' => FALSE,
        'remove_transparency' => FALSE,
        'theme' => 'inherit',
      ];

    if ($header_settings['remove_sticky']) {
      $variables['attributes']['class'][] = 'site-header-no-sticky';
    }
    else {
      $variables['attributes']['class'][] = 'site-header-sticky';
    }

    if ($header_settings['full_width']) {
      $variables['attributes']['class'][] = 'site-header-full-width';
    }
    else {
      $variables['attributes']['class'][] = 'site-header-no-full-width';
    }
  }

}
