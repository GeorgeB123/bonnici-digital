<?php

namespace Drupal\dripyard_base\Preprocess\Html;

use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocesses HTML elements to add theme colors.
 */
class ThemeColorPreprocessor extends PreprocessBase {

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
    // Get theme colors from config, merged with defaults for missing values.
    $config = \Drupal::config($this->getTheme() . '.settings')->get('theme_colors') ?? [];
    $theme_colors = array_replace_recursive($this->getDefaultThemeColors(), $config);

    // Store theme colors in variables for potential use in templates.
    $variables['theme_colors'] = $theme_colors;

    // Get any existing inline styles.
    $inline_styles = $variables['html_attributes']->hasAttribute('style')
      ? $variables['html_attributes']->storage()['style']->__toString()
      : '';

    // Add CSS custom properties for each theme color.
    foreach ($theme_colors['colors'] as $named_color => $hex_value) {
      // Skip brightness values in CSS custom properties.
      if (strpos($named_color, '_brightness') !== FALSE) {
        continue;
      }
      $color = str_replace('_', '-', $named_color);
      $inline_styles = $inline_styles . "--theme-setting-$color: $hex_value; ";
    }

    // Set the updated inline styles.
    $variables['html_attributes']->setAttribute('style', $inline_styles);

    // Add CSS class based on stored primary color brightness.
    if (isset($theme_colors['colors']['base_primary_color_brightness'])) {
      $brightness = $theme_colors['colors']['base_primary_color_brightness'];
      $variables['html_attributes']->addClass('primary-color-is-' . $brightness);
    }

    // Add CSS class based on stored secondary color brightness.
    if (isset($theme_colors['colors']['base_secondary_color_brightness'])) {
      $brightness = $theme_colors['colors']['base_secondary_color_brightness'];
      $variables['html_attributes']->addClass('secondary-color-is-' . $brightness);
    }

    // Add CSS class based on site theme selection.
    if (isset($theme_colors['site_theme'])) {
      $site_theme = $theme_colors['site_theme'];
      $variables['html_attributes']->addClass('theme--' . $site_theme);
    }
  }

  /**
   * Get default theme colors configuration.
   *
   * @return array<string, mixed>
   *   Default theme colors array.
   */
  private function getDefaultThemeColors(): array {
    return [
      'color_scheme' => 'default',
      'site_theme' => 'white',
      'colors' => [
        'base_primary_color' => '#0000d9',
        'base_primary_color_brightness' => 'dark',
        'base_secondary_color' => '#0678be',
        'base_secondary_color_brightness' => 'dark',
      ],
    ];
  }

}
