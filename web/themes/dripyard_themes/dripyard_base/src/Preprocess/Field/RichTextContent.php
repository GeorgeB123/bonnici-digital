<?php

namespace Drupal\dripyard_base\Preprocess\Field;

use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocesses rich text fields to add text-content class.
 */
class RichTextContent extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function applies($variables): bool {
    // List of field types that should be considered rich text.
    $rich_field_types = ['text_with_summary', 'text', 'text_long'];

    // Check if the field is a rich text type.
    return !empty($variables['field_type']) &&
      in_array($variables['field_type'], $rich_field_types, TRUE);
  }

  /**
   * {@inheritdoc}
   */
  public function preprocess(&$variables): void {
    // Add the text-content class to rich text fields.
    $variables['attributes']['class'][] = 'text-content';
  }

}
