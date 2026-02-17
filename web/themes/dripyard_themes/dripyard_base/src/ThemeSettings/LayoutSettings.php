<?php

namespace Drupal\dripyard_base\ThemeSettings;

use Drupal\Core\Form\FormStateInterface;

/**
 * Provides form and theme settings for layout design tokens.
 */
class LayoutSettings extends ThemeSettingsBase {

  /**
   * {@inheritdoc}
   */
  public static function getWeight(): int {
    return 2;
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
    $config = \Drupal::config($this->getTheme() . '.settings')->get('layout_settings');

    // Define defaults.
    if (empty($config)) {
      $config = [
        'container_max_width' => 1200,
        'border_radius_sm' => 4,
        'border_radius_md' => 8,
        'border_radius_lg' => 16,
        'border_radius_button' => 6,
      ];
    }

    $form['layout_settings'] = [
      '#type' => 'details',
      '#title' => t('Layout Settings'),
      '#tree' => TRUE,
    ];

    $form['layout_settings']['description'] = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => t('These settings control the global layout and design tokens for the theme.'),
    ];

    $form['layout_settings']['container_max_width'] = [
      '#type' => 'number',
      '#title' => t('Site maximum width'),
      '#description' => t('Controls the maximum width of the container of the site (in pixels).'),
      '#default_value' => $config['container_max_width'],
      '#min' => 1000,
      '#step' => 1,
    ];

    $form['layout_settings']['border_radius_sm'] = [
      '#type' => 'number',
      '#title' => t('Border radius (small)'),
      '#description' => t('Sets the global value of the small border radius (in pixels).'),
      '#default_value' => $config['border_radius_sm'],
      '#min' => 0,
      '#step' => 1,
    ];

    $form['layout_settings']['border_radius_md'] = [
      '#type' => 'number',
      '#title' => t('Border radius (medium)'),
      '#description' => t('Sets the global value of the medium border radius (in pixels).'),
      '#default_value' => $config['border_radius_md'],
      '#min' => 0,
      '#step' => 1,
    ];

    $form['layout_settings']['border_radius_lg'] = [
      '#type' => 'number',
      '#title' => t('Border radius (large)'),
      '#description' => t('Sets the global value of the large border radius (in pixels).'),
      '#default_value' => $config['border_radius_lg'],
      '#min' => 0,
      '#step' => 1,
    ];

    $form['layout_settings']['border_radius_button'] = [
      '#type' => 'number',
      '#title' => t('Border radius (button)'),
      '#description' => t('Sets the global value of the border radius on buttons (in pixels).'),
      '#default_value' => $config['border_radius_button'],
      '#min' => 0,
      '#step' => 1,
    ];

    $form['#submit'][] = [self::class, 'submitLayoutSettings'];
  }

  /**
   * Submit callback to save the settings.
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public static function submitLayoutSettings(array &$form, FormStateInterface $form_state): void {
    $layout_settings = $form_state->getValue(['layout_settings']);
    $theme = $form_state->get('theme_name');
    \Drupal::configFactory()->getEditable($theme . '.settings')
      ->set('layout_settings', $layout_settings)
      ->save();
  }

}
