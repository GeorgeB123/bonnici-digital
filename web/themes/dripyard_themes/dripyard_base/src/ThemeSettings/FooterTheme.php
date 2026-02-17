<?php

namespace Drupal\dripyard_base\ThemeSettings;

use Drupal\Core\Form\FormStateInterface;

/**
 * Provides theme settings for footer theme.
 */
class FooterTheme extends ThemeSettingsBase {

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function themeSettingsFormAlter(&$form, FormStateInterface $form_state): void {
    parent::themeSettingsFormAlter($form, $form_state);
    if (!isset($form['footer'])) {
      $form['footer'] = [
        '#type' => 'details',
        '#title' => t('Footer Settings'),
        '#open' => FALSE,
        '#tree' => TRUE,
      ];
    }

    $config = \Drupal::config($this->getTheme() . '.settings');

    $form['footer']['theme'] = [
      '#type' => 'select',
      '#title' => t('Footer Theme'),
      '#description' => t('Select the theme for the footer.'),
      '#options' => [
        'primary' => t('Primary (default)'),
        'secondary' => t('Secondary'),
        'white' => t('White'),
        'light' => t('Light'),
        'dark' => t('Dark'),
        'black' => t('Black'),
      ],
      '#default_value' => $config->get('footer.theme') ?: 'primary',
    ];

    // Add a submit handler to save the settings.
    $form['#submit'][] = [self::class, 'submitFooterSettings'];
  }

  /**
   * Submit handler for footer settings.
   *
   * @param array<string, mixed> $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public static function submitFooterSettings(array $form, FormStateInterface $form_state): void {
    $theme = $form_state->get('theme_name');
    $config = \Drupal::service('config.factory')->getEditable($theme . '.settings');
    $footer_values = $form_state->getValue('footer');

    if (isset($footer_values['theme'])) {
      $config->set('footer.theme', $footer_values['theme']);
    }

    $config->save();
  }

}
