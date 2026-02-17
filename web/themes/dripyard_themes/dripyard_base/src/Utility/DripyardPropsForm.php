<?php

namespace Drupal\dripyard_base\Utility;

/**
 * Utility class for building component props forms.
 */
class DripyardPropsForm {

  /**
   * The component name.
   *
   * @var string
   */
  protected $component;

  /**
   * The component plugin definition.
   *
   * @var array<string, mixed>
   */
  protected $definition;

  /**
   * Sets the component and loads its definition.
   *
   * @param string $component
   *   The component name (e.g., 'dripyard_base:carousel').
   */
  public function setComponent(string $component): void {
    $this->component = $component;
    $this->loadDefinition();
  }

  /**
   * Gets the current component name.
   *
   * @return string|null
   *   The component name or NULL if not set.
   */
  public function getComponent() {
    return $this->component;
  }

  /**
   * Gets the list of excluded props.
   *
   * @return array<string>
   *   Array of prop names to exclude from form generation.
   */
  public function getExcludedProps(): array {
    return [
      'canvas_edit_mode',
    ];
  }

  /**
   * Loads the component definition.
   */
  protected function loadDefinition(): void {
    if (!$this->component) {
      $this->definition = [];
      return;
    }

    try {
      $component = \Drupal::service('plugin.manager.sdc')->find($this->component);
      $this->definition = $component->getPluginDefinition();
    }
    catch (\Exception) {
      $this->definition = [];
    }
  }

  /**
   * Builds form elements based on the component props definition.
   *
   * @param array<string, mixed> $default_values
   *   Default values for the form elements.
   *
   * @return array<string, mixed>
   *   Form elements array.
   */
  public function buildFormElements(array $default_values = []): array {
    $elements = [];

    if (empty($this->definition['props']['properties'])) {
      return $elements;
    }

    // Get the list of required properties from the definition.
    $required_props = $this->definition['required'] ?? [];

    foreach ($this->definition['props']['properties'] as $prop => $shape) {
      if (in_array($prop, $this->getExcludedProps())) {
        continue;
      }

      if (!isset($shape['type'])) {
        continue;
      }
      $type = is_array($shape['type']) ? $shape['type'][0] : $shape['type'];
      if (empty($type)) {
        continue;
      }

      switch ($type) {
        case 'string':
          if (!empty($shape['enum']) && is_array($shape['enum'])) {
            $options = array_combine($shape['enum'], $shape['enum']);
            $elements[$prop] = [
              '#type' => 'select',
              '#title' => $shape['title'] ?? \ucwords($prop),
              '#options' => $options,
              '#default_value' => $default_values[$prop] ?? '',
              '#required' => in_array($prop, $required_props),
            ];
          }
          else {
            $elements[$prop] = [
              '#type' => 'textfield',
              '#title' => $shape['title'] ?? \ucwords($prop),
              '#default_value' => $default_values[$prop] ?? '',
              '#required' => in_array($prop, $required_props),
            ];
          }
          break;

        case 'boolean':
          $elements[$prop] = [
            '#type' => 'checkbox',
            '#title' => $shape['title'] ?? \ucwords($prop),
            '#default_value' => $default_values[$prop] ?? FALSE,
            '#required' => in_array($prop, $required_props),
          ];
          break;

        case 'number':
          $elements[$prop] = [
            '#type' => 'number',
            '#title' => $shape['title'] ?? $prop,
            '#default_value' => $default_values[$prop] ?? ($shape['examples'][0] ?? ''),
            '#min' => $shape['minimum'] ?? 0,
            '#max' => $shape['maximum'] ?? NULL,
            '#description' => $shape['description'] ?? '',
            '#required' => in_array($prop, $required_props),
          ];
          break;
      }
    }

    return $elements;
  }

  /**
   * Converts form values to proper types based on form element types.
   *
   * @param array<string, mixed> $form_elements
   *   The form elements.
   * @param array<string, mixed> $values
   *   The form values to convert.
   *
   * @return array<string, mixed>
   *   The converted values.
   */
  public function convertFormValues(array $form_elements, array $values) {
    $converted = $values;

    foreach ($values as $key => $value) {
      if (isset($form_elements[$key]['#type'])) {
        switch ($form_elements[$key]['#type']) {
          case 'checkbox':
            $converted[$key] = (bool) $value;
            break;

          case 'number':
            $converted[$key] = (int) $value;
            break;
        }
      }
    }

    return $converted;
  }

}
