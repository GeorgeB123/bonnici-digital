<?php

namespace Drupal\dripyard_base\Preprocess\Block;

/**
 * Preprocess logic for cta fields.
 */
class DripyardComponentTheme extends FieldableEntityPreprocessor {

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $variables
   *   The variables to process.
   */
  public function preprocess(&$variables): void {
    foreach ($this->entity->get($this->fieldName) as $item) {
      $variables['props']['dripyard_component_theme'] = $item->getValue()['value'];
    }
  }

  /**
   * Returns fields that apply to this preprocessor.
   *
   * @return array<int, string>
   *   An array of field names.
   */
  protected function getFields() {
    return [
      'dripyard_component_theme',
    ];
  }

}
