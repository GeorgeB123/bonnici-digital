<?php

namespace Drupal\dripyard_base\Preprocess\Block;

use Drupal\Core\Entity\FieldableEntityInterface;
use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Provides a base class for fieldable entity preprocessors.
 */
abstract class FieldableEntityPreprocessor extends PreprocessBase {

  /**
   * Stores the field name for the preprocessor.
   *
   * @var string
   */
  protected $fieldName;

  /**
   * The entity.
   *
   * @var \Drupal\Core\Entity\FieldableEntityInterface
   */
  protected $entity;

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $variables
   *   The variables to check.
   *
   * @return bool
   *   TRUE if the preprocessor should apply.
   */
  public function applies($variables): bool {
    foreach ($this->getFields() as $field_name) {
      if (!empty($variables['content'][$field_name]['#items'])) {
        $this->fieldName = $field_name;
        $this->entity = $this->getEntity($variables);
        return $this->entity !== NULL;
      }
    }
    return FALSE;
  }

  /**
   * Resolves the entity from the render array.
   *
   * @param array<string, mixed> $variables
   *   The preprocess variables.
   *
   * @return \Drupal\Core\Entity\FieldableEntityInterface|null
   *   The entity.
   */
  protected function getEntity(array $variables) {
    $keys = [
      '#block_content',
    ];
    foreach ($keys as $key) {
      if (!empty($variables['content'][$key]) && $variables['content'][$key] instanceof FieldableEntityInterface) {
        return $variables['content'][$key];
      }
    }
    return NULL;
  }

  /**
   * Should return the fields the preprocessor works on.
   *
   * @return array<int, string>
   *   The fields.
   */
  protected function getFields() {
    return [];
  }

}
