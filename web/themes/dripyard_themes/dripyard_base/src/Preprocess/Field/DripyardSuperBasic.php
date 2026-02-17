<?php

namespace Drupal\dripyard_base\Preprocess\Field;

use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocess logic for fields using the dripyard_superbasic format.
 */
class DripyardSuperBasic extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function applies($variables): bool {
    // Check if this is a field with the dripyard_superbasic format.
    if (!empty($variables['element']['#items'])) {
      foreach ($variables['items'] as $item) {
        if (!empty($item['content']['#format']) && $item['content']['#format'] === 'dripyard_superbasic') {
          return TRUE;
        }
      }
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   *
   * Strips P tags from markup and creates props.
   */
  public function preprocess(&$variables): void {
    // Process each item in the field.
    foreach ($variables['items'] as &$item) {
      if (!empty($item['content']['#text']) && !empty($item['content']['#format']) && $item['content']['#format'] === 'dripyard_superbasic') {
        $value = $item['content']['#text'];

        // Replace adjacent closing and opening p tags with a line break
        $value = preg_replace('/<\/p>\s*<p>/s', '<br />', $value);

        // Then strip all remaining p tags
        $value = preg_replace('/<p>(.*?)<\/p>/s', '$1', $value);

        // Update the content text
        $item['content']['#text'] = $value;
      }
    }
  }

}
