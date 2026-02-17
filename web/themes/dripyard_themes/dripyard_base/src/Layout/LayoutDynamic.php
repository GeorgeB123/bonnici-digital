<?php

namespace Drupal\dripyard_base\Layout;

use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a dynamic layout class for Dripyard.
 */
class LayoutDynamic extends LayoutBase {

  /**
   * {@inheritdoc}
   *
   * @return array<string, mixed>
   *   The default configuration.
   */
  public function defaultConfiguration() {
    return [
      'column_count' => 1,
      'row_count' => 1,
      'two_column_layout' => '50% / 50%',
      'three_column_layout' => '33% / 33% / 33%',
      'section_width' => 'edge-to-edge',
      'content_width' => 'max-width',
      'cell_align_x' => NULL,
      'cell_align_y' => NULL,
      'margin_top' => NULL,
      'margin_bottom' => NULL,
      'padding_top' => NULL,
      'padding_bottom' => NULL,
      'column_gutter' => NULL,
      'row_gutter' => NULL,
      'additional_classes' => '',
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return array<string, mixed>
   *   The form array.
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    // Clear out any fields already added by parent to rebuild them in our structure
    $form['dripyard'] = [
      '#type' => 'details',
      '#title' => $this->t('Dynamic Layout Configuration'),
      '#open' => TRUE,
    ];

    // Add only the theme field from base class in main section
    $main_base_fields = ['dripyard_theme'];
    foreach ($main_base_fields as $key) {
      $form_element = $this->getFormElement($key);
      if (isset($form_element)) {
        $form['dripyard'][$key] = $form_element;
      }
    }

    // Add dynamic layout specific fields
    $dynamic_fields = ['column_count', 'row_count', 'two_column_layout', 'three_column_layout', 'section_width', 'content_width'];
    foreach ($dynamic_fields as $key) {
      $form_element = $this->getFormElement($key);
      if (isset($form_element)) {
        $form['dripyard'][$key] = $form_element;
      }
    }

    // Add layout customization fields in a collapsed fieldset
    $form['dripyard']['layout_customization'] = [
      '#type' => 'details',
      '#title' => $this->t('Layout Customization'),
      '#open' => FALSE,
    ];

    $layout_fields = ['cell_align_x', 'cell_align_y', 'additional_classes'];
    foreach ($layout_fields as $key) {
      $form_element = $this->getFormElement($key);
      if (isset($form_element)) {
        $form['dripyard']['layout_customization'][$key] = $form_element;
      }
    }

    // Add spacing fields in a collapsed fieldset
    $form['dripyard']['spacing_options'] = [
      '#type' => 'details',
      '#title' => $this->t('Spacing Options'),
      '#open' => FALSE,
    ];

    $spacing_fields = ['margin_top', 'margin_bottom', 'padding_top', 'padding_bottom', 'column_gutter', 'row_gutter'];
    foreach ($spacing_fields as $key) {
      $form_element = $this->getFormElement($key);
      if (isset($form_element)) {
        unset($form_element['#states']);
        $form['dripyard']['spacing_options'][$key] = $form_element;
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

    // Handle dynamic layout specific fields (not handled by parent)
    $dynamic_fields = ['column_count', 'row_count', 'two_column_layout', 'three_column_layout', 'section_width', 'content_width'];
    foreach ($dynamic_fields as $key) {
      if (isset($dripyard[$key])) {
        $this->configuration[$key] = is_numeric($dripyard[$key]) ? intval($dripyard[$key]) : $dripyard[$key];
      }
    }

    // Handle layout customization options from the nested fieldset
    if (isset($dripyard['layout_customization'])) {
      $layout_fields = ['cell_align_x', 'cell_align_y', 'additional_classes'];
      foreach ($layout_fields as $key) {
        if (isset($dripyard['layout_customization'][$key])) {
          $this->configuration[$key] = $dripyard['layout_customization'][$key];
        }
      }
    }

    // Handle spacing options from the nested fieldset
    if (isset($dripyard['spacing_options'])) {
      $spacing_fields = ['margin_top', 'margin_bottom', 'padding_top', 'padding_bottom', 'column_gutter', 'row_gutter'];
      foreach ($spacing_fields as $key) {
        if (isset($dripyard['spacing_options'][$key])) {
          $this->configuration[$key] = $dripyard['spacing_options'][$key];
        }
      }
    }
  }

  /**
   * {@inheritdoc}
   *
   * @return array<string, mixed>
   *   The form elements array.
   */
  protected function getFormElements(): array {
    $form_elements = parent::getFormElements();

    $form_elements['column_count'] = [
      '#type' => 'select',
      '#title' => $this->t('Columns'),
      '#description' => $this->t('Number of columns for the layout grid.'),
      '#default_value' => $this->configuration['column_count'],
      '#required' => TRUE,
      '#options' => [
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
      ],
    ];

    $form_elements['row_count'] = [
      '#type' => 'select',
      '#title' => $this->t('Rows'),
      '#description' => $this->t('Number of rows for the layout grid.'),
      '#default_value' => $this->configuration['row_count'],
      '#required' => TRUE,
      '#options' => [
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
      ],
    ];

    $form_elements['two_column_layout'] = [
      '#type' => 'select',
      '#title' => $this->t('Two Column Options'),
      '#description' => $this->t('Width distribution for two columns.'),
      '#default_value' => $this->configuration['two_column_layout'],
      '#options' => [
        '50% / 50%' => '50% / 50%',
        '25% / 75%' => '25% / 75%',
        '33% / 67%' => '33% / 67%',
        '75% / 25%' => '75% / 25%',
        '67% / 33%' => '67% / 33%',
      ],
      '#states' => [
        'visible' => [
          ':input[name="layout_settings[dripyard][column_count]"]' => ['value' => '2'],
        ],
      ],
    ];

    $form_elements['three_column_layout'] = [
      '#type' => 'select',
      '#title' => $this->t('Three Column Options'),
      '#description' => $this->t('Width distribution for three columns.'),
      '#default_value' => $this->configuration['three_column_layout'],
      '#options' => [
        '33% / 33% / 33%' => '33% / 33% / 33%',
        '50% / 25% / 25%' => '50% / 25% / 25%',
        '25% / 50% / 25%' => '25% / 50% / 25%',
        '25% / 25% / 50%' => '25% / 25% / 50%',
      ],
      '#states' => [
        'visible' => [
          ':input[name="layout_settings[dripyard][column_count]"]' => ['value' => '3'],
        ],
      ],
    ];

    $spacing_options = [
      '' => $this->t('- No Override -'),
      'zero' => $this->t('Zero'),
      'small' => $this->t('Small'),
      'medium' => $this->t('Medium'),
      'large' => $this->t('Large'),
    ];

    $form_elements['margin_top'] = [
      '#type' => 'select',
      '#title' => $this->t('Override Top Margin'),
      '#description' => $this->t('Overrides the external spacing at the top of the component.'),
      '#default_value' => $this->configuration['margin_top'],
      '#options' => $spacing_options,
    ];

    $form_elements['margin_bottom'] = [
      '#type' => 'select',
      '#title' => $this->t('Override Bottom Margin'),
      '#description' => $this->t('Overrides the external spacing at the bottom of the component.'),
      '#default_value' => $this->configuration['margin_bottom'],
      '#options' => $spacing_options,
    ];

    $form_elements['padding_top'] = [
      '#type' => 'select',
      '#title' => $this->t('Override Top Padding'),
      '#description' => $this->t('Overrides the internal spacing at the top of the component.'),
      '#default_value' => $this->configuration['padding_top'],
      '#options' => $spacing_options,
    ];

    $form_elements['padding_bottom'] = [
      '#type' => 'select',
      '#title' => $this->t('Override Bottom Padding'),
      '#description' => $this->t('Overrides the internal spacing at the bottom of the component.'),
      '#default_value' => $this->configuration['padding_bottom'],
      '#options' => $spacing_options,
    ];

    $form_elements['column_gutter'] = [
      '#type' => 'select',
      '#title' => $this->t('Override Column Gutter Width'),
      '#description' => $this->t('Override the horizontal spacing between columns.'),
      '#default_value' => $this->configuration['column_gutter'],
      '#options' => $spacing_options,
    ];

    $form_elements['row_gutter'] = [
      '#type' => 'select',
      '#title' => $this->t('Override Row Gutter Width'),
      '#description' => $this->t('Override the vertical spacing between rows.'),
      '#default_value' => $this->configuration['row_gutter'],
      '#options' => $spacing_options,
    ];

    $form_elements['section_width'] = [
      '#type' => 'select',
      '#title' => $this->t('Section Width'),
      '#description' => $this->t('Controls whether the layout will span the full width of the screen, or be constrained to the max-width.'),
      '#default_value' => $this->configuration['section_width'],
      '#required' => TRUE,
      '#options' => [
        'edge-to-edge' => $this->t('Edge to Edge'),
        'max-width' => $this->t('Max Width'),
      ],
    ];

    $form_elements['content_width'] = [
      '#type' => 'select',
      '#title' => $this->t('Content Width'),
      '#description' => $this->t('Controls the width of the content.'),
      '#default_value' => $this->configuration['content_width'],
      '#required' => TRUE,
      '#options' => [
        'edge-to-edge' => $this->t('Edge to Edge'),
        'max-width' => $this->t('Max Width'),
        'narrow' => $this->t('Narrow'),
      ],
    ];

    $form_elements['additional_classes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Additional CSS Classes'),
      '#description' => $this->t('Additional CSS classes that will be added to the wrapper of the section layout (separated by spaces).'),
      '#default_value' => $this->configuration['additional_classes'],
    ];

    return $form_elements;
  }

}
