<?php

namespace Drupal\dripyard_base\Layout;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Layout\LayoutDefault;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\dripyard_base\Layout\Traits\ComponentWrapperTrait;

/**
 * Provides a base layout class for all Dripyard layouts.
 */
class LayoutBase extends LayoutDefault {
  use StringTranslationTrait;
  use ComponentWrapperTrait;

  /**
   * {@inheritdoc}
   */
  public function build(array $regions) {
    $build = parent::build($regions);

    // Unset all array keys in $build that are empty.
    foreach ($build['#settings'] as $key => $value) {
      if (empty($value)) {
        unset($build['#settings'][$key]);
      }
    }

    // Only invoke component wrapper functionality if not in preview mode.
    if (!$this->inPreview) {
      return $this->processComponentWrapper($regions, $build);
    }

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'dripyard_theme' => 'inherit',
      'dripyard_layout' => 'default',
      'cell_align_x' => 'start',
      'cell_align_y' => 'top',
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['dripyard'] = [
      '#type' => 'details',
      '#title' => $this->t('Dripyard Section Configuration'),
      '#open' => TRUE,
    ];

    foreach (array_keys($this->defaultConfiguration()) as $key) {
      $form_element = $this->getFormElement($key);
      if (isset($form_element)) {
        $form['dripyard'][$key] = $form_element;
      }
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state): void {
    parent::submitConfigurationForm($form, $form_state);
    $dripyard = $form_state->getValue('dripyard');
    foreach (array_keys($this->defaultConfiguration()) as $key) {
      if (isset($dripyard[$key])) {
        $this->configuration[$key] = is_numeric($dripyard[$key]) ? intval($dripyard[$key]) : $dripyard[$key];
      }
    }
  }

  /**
   * Gets the form element for the layout configuration forms.
   *
   * @param string $key
   *   The key of the form element to be created.
   *
   * @return array<string, mixed>|null
   *   The form element array or NULL if the key does not exist.
   */
  protected function getFormElement($key) {
    $form_elements = $this->getFormElements();
    if (isset($form_elements[$key])) {
      return $form_elements[$key];
    }
    return NULL;
  }

  /**
   * Provides all form elements for the layout configuration forms.
   *
   * @return array<string, mixed>
   *   The form elements array.
   */
  protected function getFormElements(): array {
    $form_elements['dripyard_layout'] = [
      '#type' => 'select',
      '#title' => $this->t('Section Layout'),
      '#description' => $this->t('Layout style for the section container.'),
      '#default_value' => $this->configuration['dripyard_layout'] ?? 'default',
      '#required' => TRUE,
      '#options' => [
        'default' => $this->t('Default'),
        'narrow' => $this->t('Narrow'),
      ],
    ];

    $form_elements['dripyard_theme'] = [
      '#type' => 'select',
      '#title' => $this->t('Section Theme'),
      '#description' => $this->t('Color theme for the section.'),
      '#default_value' => $this->configuration['dripyard_theme'] ?? 'inherit',
      '#required' => TRUE,
      '#options' => [
        'inherit' => $this->t('Inherit'),
        'white' => $this->t('White'),
        'light' => $this->t('Light'),
        'dark' => $this->t('Dark'),
        'black' => $this->t('Black'),
        'primary' => $this->t('Primary'),
        'secondary' => $this->t('Secondary'),
      ],
    ];

    $form_elements['cell_align_x'] = [
      '#type' => 'select',
      '#title' => $this->t('Cell Horizontal Alignment'),
      '#description' => $this->t('Sets horizontal alignment of content within all grid cells.'),
      '#empty_option' => $this->t('- None -'),
      '#default_value' => $this->configuration['cell_align_x'] ?? '',
      '#options' => [
        'start' => $this->t('Start'),
        'center' => $this->t('Center'),
        'end' => $this->t('End'),
      ],
    ];

    $form_elements['cell_align_y'] = [
      '#type' => 'select',
      '#title' => $this->t('Cell Vertical Alignment'),
      '#description' => $this->t('Sets vertical alignment of content within all grid cells.'),
      '#empty_option' => $this->t('- None -'),
      '#default_value' => $this->configuration['cell_align_y'] ?? '',
      '#options' => [
        'top' => $this->t('Top'),
        'center' => $this->t('Center'),
        'bottom' => $this->t('Bottom'),
      ],
    ];

    return $form_elements;
  }

}
