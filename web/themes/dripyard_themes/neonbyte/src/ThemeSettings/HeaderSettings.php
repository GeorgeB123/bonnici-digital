<?php

namespace Drupal\neonbyte\ThemeSettings;

use Drupal\dripyard_base\ThemeSettings\ThemeSettingsBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides form and theme settings for header customization.
 */
class HeaderSettings extends ThemeSettingsBase {

  /**
   * The theme settings form alter.
   *
   * @param array<string, mixed> $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function themeSettingsFormAlter(array &$form, FormStateInterface $form_state): void {
    parent::themeSettingsFormAlter($form, $form_state);
    $config = \Drupal::config($this->getTheme() . '.settings')->get('header_settings');

    // Define defaults.
    if (empty($config)) {
      $config = [
        'full_width' => FALSE,
        'remove_sticky' => FALSE,
        'remove_transparency' => FALSE,
        'theme' => 'inherit',
      ];
    }

    $form['header_settings'] = [
      '#type' => 'details',
      '#title' => t('Header Settings'),
      '#tree' => TRUE,
    ];

    $form['header_settings']['description'] = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => t('These settings control the appearance and behavior of the site header.'),
    ];

    $form['header_settings']['full_width'] = [
      '#type' => 'checkbox',
      '#title' => t('Full width header'),
      '#description' => t('Makes the header full width.'),
      '#default_value' => $config['full_width'],
    ];

    $form['header_settings']['remove_sticky'] = [
      '#type' => 'checkbox',
      '#title' => t('Remove stickyness'),
      '#description' => t('Removes the "Stickyness" (<code>position: fixed</code>) from the header, and puts it at the top of the page.'),
      '#default_value' => $config['remove_sticky'],
    ];

    $form['header_settings']['remove_transparency'] = [
      '#type' => 'checkbox',
      '#title' => t('Remove transparency'),
      '#description' => t('Removes the transparent "frosted" effect from the header.'),
      '#default_value' => $config['remove_transparency'],
    ];

    $form['header_settings']['theme'] = [
      '#type' => 'select',
      '#title' => t('Theme'),
      '#description' => t('Color theme of the header.'),
      '#default_value' => $config['theme'],
      '#options' => [
        'inherit' => t('Inherit'),
        'white' => t('White'),
        'light' => t('Light'),
        'dark' => t('Dark'),
        'black' => t('Black'),
        'primary' => t('Primary'),
        'secondary' => t('Secondary'),
      ],
    ];

    $form['#submit'][] = [self::class, 'submitHeaderSettings'];
  }

  /**
   * Submit callback to save the settings.
   *
   * @param array<string, mixed> $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public static function submitHeaderSettings(array &$form, FormStateInterface $form_state): void {
    $header_settings = $form_state->getValue(['header_settings']);
    $theme = $form_state->get('theme_name');
    \Drupal::configFactory()->getEditable($theme . '.settings')
      ->set('header_settings', $header_settings)
      ->save();
  }

}
