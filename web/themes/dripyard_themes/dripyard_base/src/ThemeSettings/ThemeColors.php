<?php

namespace Drupal\dripyard_base\ThemeSettings;

use Drupal\Core\Form\FormStateInterface;
use Drupal\dripyard_base\Interface\WeightedInterface;

/**
 * Provides form and theme settings for changing colors.
 */
class ThemeColors extends ThemeSettingsBase implements WeightedInterface {

  /**
   * {@inheritdoc}
   */
  public static function getWeight(): int {
    return 1;
  }

  /**
   * The theme settings form alter.
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function themeSettingsFormAlter(array &$form, FormStateInterface $form_state): void {
    parent::themeSettingsFormAlter($form, $form_state);
    $config = \Drupal::config($this->getTheme() . '.settings');
    $theme_colors = $config->get('theme_colors') ?: [];

    // Define defaults.
    if (empty($theme_colors)) {
      $default_primary_color = '#0000d9';
      $default_secondary_color = '#7a4587';
      $theme_colors = [
        'color_scheme' => 'default',
        'site_theme' => 'white',
        'colors' => [
          'base_primary_color' => $default_primary_color,
          'base_primary_color_brightness' => $this->isLightColor($default_primary_color) ? 'light' : 'dark',
          'base_secondary_color' => $default_secondary_color,
          'base_secondary_color_brightness' => $this->isLightColor($default_secondary_color) ? 'light' : 'dark',
        ],
      ];
    }

    $form['#attached']['drupalSettings']['dripyard']['colorSchemes'] = $this->getThemeColorOptions()['schemes'];
    $form['#attached']['library'][] = 'dripyard_base/color-picker';

    $form['theme_colors'] = [
      '#type' => 'details',
      '#title' => t('Color Scheme Settings'),
      '#tree' => TRUE,
    ];
    $form['theme_colors']['description'] = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => t('These settings adjust the look and feel of the theme. Changing the color below will change the base colors the theme uses to determine derivative colors.'),
    ];
    $form['theme_colors']['color_scheme'] = [
      '#type' => 'select',
      '#title' => t('Color Scheme'),
      '#empty_option' => t('Custom'),
      '#empty_value' => '',
      '#default_value' => $theme_colors['color_scheme'],
      '#options' => [
        'default' => t('Blue (Default)'),
        'firehouse' => t('Firehouse'),
        'ice' => t('Ice'),
        'plum' => t('Plum'),
        'slate' => t('Slate'),
      ],
    ];

    foreach ($this->getThemeColorOptions()['colors'] as $key => $title) {
      $form['theme_colors']['colors'][$key] = [
        '#type' => 'textfield',
        '#maxlength' => 7,
        '#size' => 10,
        '#title' => t($title),
        '#default_value' => $theme_colors['colors'][$key],
        '#description' => t('Enter color in hexadecimal format (#abc123).') . '<br/>' . t('Derivatives will be formed from this color.'),
        '#attributes' => [
          'pattern' => '^[#]?([0-9a-fA-F]{3}){1,2}$',
        ],
        '#wrapper_attributes' => [
          'data-drupal-selector' => 'color-picker',
        ],
      ];

      // Add hidden field for brightness value
      $brightness_key = $key . '_brightness';
      $form['theme_colors']['colors'][$brightness_key] = [
        '#type' => 'hidden',
        '#default_value' => $theme_colors['colors'][$brightness_key] ?? 'light',
        '#value' => $theme_colors['colors'][$brightness_key] ?? 'light',
      ];
    }

    $form['theme_colors']['site_theme'] = [
      '#type' => 'select',
      '#title' => t('Site Theme'),
      '#description' => t('Select the overall theme for the site. This sets the default surface colors for the background and text.'),
      '#options' => [
        'primary' => t('Primary'),
        'secondary' => t('Secondary'),
        'white' => t('White'),
        'light' => t('Light'),
        'dark' => t('Dark'),
        'black' => t('Black'),
      ],
      '#default_value' => $theme_colors['site_theme'] ?? 'white',
    ];

    // Add validation handler to calculate brightness before form submission
    $form['#validate'][] = [self::class, 'validateColorScheme'];

    // Add our submit handler to run AFTER the default theme settings submit.
    $form['#submit'][] = [self::class, 'submitColorScheme'];
  }

  /**
   * Validation callback to calculate brightness.
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public static function validateColorScheme(array &$form, FormStateInterface $form_state): void {
    $theme_colors = $form_state->getValue(['theme_colors']) ?: [];
    $instance = new self();

    // Calculate brightness for all color options and update form state.
    foreach ($instance->getThemeColorOptions()['colors'] as $color_key => $title) {
      $color_value = $theme_colors['colors'][$color_key];
      $brightness = static::isLightColor($color_value) ? 'light' : 'dark';
      $brightness_key = $color_key . '_brightness';
      $form_state->setValue(['theme_colors', 'colors', $brightness_key], $brightness);
    }
  }

  /**
   * Submit callback to save the settings.
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public static function submitColorScheme(array &$form, FormStateInterface $form_state): void {
    // Get the currently saved theme colors (after default submit handler).
    $theme = $form_state->get('theme_name');
    $config = \Drupal::configFactory()->getEditable($theme . '.settings');
    $theme_colors = $form_state->getValue(['theme_colors']) ?: [];
    $instance = new self();

    // If a predefined color scheme is selected, use its colors.
    if (!empty($theme_colors['color_scheme'])) {
      $schemes = $instance->getThemeColorOptions()['schemes'];
      if (isset($schemes[$theme_colors['color_scheme']])) {
        $scheme_colors = $schemes[$theme_colors['color_scheme']]['colors'];
        // Update colors and brightness from scheme (no need to calculate)
        $theme_colors['colors'] = $scheme_colors;
      }
    }

    // Only calculate brightness if no predefined scheme is selected
    if (empty($theme_colors['color_scheme'])) {
      // Calculate and store brightness for all colors.
      foreach ($instance->getThemeColorOptions()['colors'] as $color_key => $title) {
        if (isset($theme_colors['colors'][$color_key])) {
          $color_value = $theme_colors['colors'][$color_key];
          $brightness_key = $color_key . '_brightness';
          $theme_colors['colors'][$brightness_key] = static::isLightColor($color_value) ? 'light' : 'dark';
        }
      }
    }

    // Save the theme colors configuration.
    $config->set('theme_colors', $theme_colors)->save();
  }

  /**
   * Defines the available color types and schemes.
   *
   * @return array<string, array<string, mixed>>
   *   The theme color options.
   */
  public function getThemeColorOptions() {
    return [
      'colors' => [
        'base_primary_color' => 'Primary base color',
        'base_secondary_color' => 'Secondary base color',
      ],
      'schemes' => [
        'default' => [
          'label' => 'Blue',
          'colors' => [
            'base_primary_color' => '#0000d9',
            'base_primary_color_brightness' => 'dark',
            'base_secondary_color' => '#7a4587',
            'base_secondary_color_brightness' => 'dark',
          ],
        ],
        'firehouse' => [
          'label' => 'Firehouse',
          'colors' => [
            'base_primary_color' => '#a30f0f',
            'base_primary_color_brightness' => 'dark',
            'base_secondary_color' => '#d45f00',
            'base_secondary_color_brightness' => 'dark',
          ],
        ],
        'ice' => [
          'label' => 'Ice',
          'colors' => [
            'base_primary_color' => '#57919e',
            'base_primary_color_brightness' => 'dark',
            'base_secondary_color' => '#2d5a87',
            'base_secondary_color_brightness' => 'dark',
          ],
        ],
        'plum' => [
          'label' => 'Plum',
          'colors' => [
            'base_primary_color' => '#7a4587',
            'base_primary_color_brightness' => 'dark',
            'base_secondary_color' => '#4a6b8a',
            'base_secondary_color_brightness' => 'dark',
          ],
        ],
        'slate' => [
          'label' => 'Slate',
          'colors' => [
            'base_primary_color' => '#47625b',
            'base_primary_color_brightness' => 'dark',
            'base_secondary_color' => '#5a4a3a',
            'base_secondary_color_brightness' => 'dark',
          ],
        ],
      ],
    ];
  }

  /**
   * Determines if a color is light or dark based on LCH lightness.
   *
   * Converts hex color to LCH color space and compares lightness value.
   * LCH provides more perceptually uniform lightness than relative luminance.
   *
   * @param string $hex
   *   The hex color value (with or without #).
   *
   * @return bool
   *   TRUE if the color is light, FALSE if dark.
   */
  public static function isLightColor($hex) {
    // Remove # if present.
    $hex = ltrim($hex, '#');

    // Convert hex to RGB.
    $r = hexdec(substr($hex, 0, 2)) / 255;
    $g = hexdec(substr($hex, 2, 2)) / 255;
    $b = hexdec(substr($hex, 4, 2)) / 255;

    // Convert RGB to LCH via XYZ and LAB.
    $lch = self::rgbToLch($r, $g, $b);

    // Return true if light (lightness > 50), false if dark.
    return $lch['l'] > 50;
  }

  /**
   * Converts RGB to LCH color space.
   *
   * @param float $r
   *   Red component (0-1).
   * @param float $g
   *   Green component (0-1).
   * @param float $b
   *   Blue component (0-1).
   *
   * @return array<string, float>
   *   Array with 'l' (lightness), 'c' (chroma), 'h' (hue) values.
   */
  private static function rgbToLch($r, $g, $b) {
    // First convert RGB to XYZ.
    $xyz = self::rgbToXyz($r, $g, $b);

    // Convert XYZ to LAB.
    $lab = self::xyzToLab($xyz['x'], $xyz['y'], $xyz['z']);

    // Convert LAB to LCH.
    $c = sqrt($lab['a'] * $lab['a'] + $lab['b'] * $lab['b']);
    $h = atan2($lab['b'], $lab['a']) * 180 / pi();
    if ($h < 0) {
      $h += 360;
    }

    return [
      'l' => $lab['l'],
      'c' => $c,
      'h' => $h,
    ];
  }

  /**
   * Converts RGB to XYZ color space.
   *
   * @param float $r
   *   Red component (0-1).
   * @param float $g
   *   Green component (0-1).
   * @param float $b
   *   Blue component (0-1).
   *
   * @return array<string, float>
   *   Array with 'x', 'y', 'z' values.
   */
  private static function rgbToXyz($r, $g, $b) {
    // Apply gamma correction.
    $r = ($r > 0.04045) ? pow(($r + 0.055) / 1.055, 2.4) : $r / 12.92;
    $g = ($g > 0.04045) ? pow(($g + 0.055) / 1.055, 2.4) : $g / 12.92;
    $b = ($b > 0.04045) ? pow(($b + 0.055) / 1.055, 2.4) : $b / 12.92;

    // Observer. = 2°, Illuminant = D65.
    $x = $r * 0.4124564 + $g * 0.3575761 + $b * 0.1804375;
    $y = $r * 0.2126729 + $g * 0.7151522 + $b * 0.0721750;
    $z = $r * 0.0193339 + $g * 0.1191920 + $b * 0.9503041;

    return ['x' => $x * 100, 'y' => $y * 100, 'z' => $z * 100];
  }

  /**
   * Converts XYZ to LAB color space.
   *
   * @param float $x
   *   X component.
   * @param float $y
   *   Y component.
   * @param float $z
   *   Z component.
   *
   * @return array<string, float>
   *   Array with 'l', 'a', 'b' values.
   */
  private static function xyzToLab($x, $y, $z) {
    // Reference white D65.
    $xn = 95.047;
    $yn = 100.000;
    $zn = 108.883;

    $x = $x / $xn;
    $y = $y / $yn;
    $z = $z / $zn;

    $fx = ($x > 0.008856) ? pow($x, 1 / 3) : (7.787 * $x + 16 / 116);
    $fy = ($y > 0.008856) ? pow($y, 1 / 3) : (7.787 * $y + 16 / 116);
    $fz = ($z > 0.008856) ? pow($z, 1 / 3) : (7.787 * $z + 16 / 116);

    $l = 116 * $fy - 16;
    $a = 500 * ($fx - $fy);
    $b = 200 * ($fy - $fz);

    return ['l' => $l, 'a' => $a, 'b' => $b];
  }

}
