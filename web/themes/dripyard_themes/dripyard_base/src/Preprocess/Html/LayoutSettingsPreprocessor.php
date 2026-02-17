<?php

namespace Drupal\dripyard_base\Preprocess\Html;

use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocesses HTML elements to add layout design tokens.
 */
class LayoutSettingsPreprocessor extends PreprocessBase {

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
    // Get layout settings from configuration.
    $layout_settings = \Drupal::config($this->getTheme() . '.settings')->get('layout_settings')
      ?? [
        'container_max_width' => 1200,
        'border_radius_sm' => 4,
        'border_radius_md' => 8,
        'border_radius_lg' => 16,
        'border_radius_button' => 6,
      ];

    // Store layout settings in variables for potential use in templates.
    $variables['layout_settings'] = $layout_settings;

    // Get any existing inline styles.
    $inline_styles = $variables['html_attributes']->hasAttribute('style')
      ? $variables['html_attributes']->storage()['style']->__toString()
      : '';

    // Add CSS custom properties for layout settings.
    $inline_styles .= "--theme-setting-container-max-pixel: {$layout_settings['container_max_width']}px; ";
    $inline_styles .= "--theme-setting-radius-sm: {$layout_settings['border_radius_sm']}px; ";
    $inline_styles .= "--theme-setting-radius-md: {$layout_settings['border_radius_md']}px; ";
    $inline_styles .= "--theme-setting-radius-lg: {$layout_settings['border_radius_lg']}px; ";
    $inline_styles .= "--theme-setting-radius-button: {$layout_settings['border_radius_button']}px; ";

    // Set the updated inline styles.
    $variables['html_attributes']->setAttribute('style', $inline_styles);
  }

}
