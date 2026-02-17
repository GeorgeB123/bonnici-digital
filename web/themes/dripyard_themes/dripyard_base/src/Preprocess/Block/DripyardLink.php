<?php

namespace Drupal\dripyard_base\Preprocess\Block;

use Drupal\Core\Url;

/**
 * Preprocess logic for link fields.
 */
class DripyardLink extends FieldableEntityPreprocessor {

  /**
   * {@inheritdoc}
   *
   * Converts all instances of dripyard_link field into component friendly
   * props values.
   *
   * @param array<string, mixed> $variables
   *   The variables to process.
   */
  public function preprocess(&$variables): void {
    // Populate a dripyard_ctas array with component friendly values.
    foreach ($this->entity->get($this->fieldName) as $item) {
      $link = $item->getValue();
      $href = Url::fromUri($link['uri']);
      $variables['props']['dripyard_link'][] = [
        'href' => $href->toString(),
        'text' => $link['title'],
      ];
    }
  }

  /**
   * {@inheritdoc}
   *
   * @return array<int, string>
   *   An array of field names.
   */
  protected function getFields() {
    return [
      'dripyard_link',
    ];
  }

}
