<?php

namespace Drupal\dripyard_base\Preprocess\Block;

use Drupal\Core\Url;

/**
 * Preprocess logic for cta fields.
 */
class DripyardCta extends FieldableEntityPreprocessor {

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $variables
   *   The variables to process.
   */
  public function preprocess(&$variables): void {
    // Populate a dripyard_ctas array with component friendly values.
    foreach ($this->entity->get($this->fieldName) as $delta => $item) {
      $cta = $item->getValue();
      $href = Url::fromUri($cta['uri']);
      $variables['props']['dripyard_cta'][] = [
        'href' => $href->toString(),
        'text' => $cta['title'],
        'suffix_icon' => $delta == 0 ? 'arrow-right' : '',
        'size' => 'large',
        'style' => $delta == 0 ? 'primary' : '',
      ];
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
      'dripyard_cta',
      'dripyard_ctas',
    ];
  }

}
