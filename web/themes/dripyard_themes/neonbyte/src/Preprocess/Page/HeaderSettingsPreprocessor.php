<?php

namespace Drupal\neonbyte\Preprocess\Page;

use Drupal\dripyard_base\Preprocess\PreprocessBase;
use Drupal\Core\Template\Attribute;

/**
 * Preprocesses page template to add header attributes based on settings.
 */
class HeaderSettingsPreprocessor extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function applies($variables): bool {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function preprocess(&$variables): void {
    // Get header settings from configuration.
    $header_settings = \Drupal::config($this->getTheme() . '.settings')->get('header_settings')
      ?? [
        'full_width' => FALSE,
        'remove_sticky' => FALSE,
        'remove_transparency' => FALSE,
        'theme' => 'inherit',
      ];

    // Initialize header_attributes if it doesn't exist.
    if (!isset($variables['header_attributes'])) {
      $variables['header_attributes'] = new Attribute();
    }

    // Build CSS classes based on settings.
    $header_classes = [];

    if ($header_settings['full_width']) {
      $header_classes[] = 'header--full-width';
    }

    if ($header_settings['remove_sticky']) {
      $header_classes[] = 'header--no-fixed';
    }

    if ($header_settings['remove_transparency']) {
      $header_classes[] = 'header--no-transparency';
    }

    // Add theme class only if not inherit.
    if ($header_settings['theme'] !== 'inherit') {
      $header_classes[] = 'theme--' . $header_settings['theme'];
    }

    // Add classes to header_attributes.
    if (!empty($header_classes)) {
      $variables['header_attributes']->addClass($header_classes);
    }
  }

}
