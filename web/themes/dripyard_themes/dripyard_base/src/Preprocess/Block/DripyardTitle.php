<?php

namespace Drupal\dripyard_base\Preprocess\Block;

use Drupal\Core\Render\Markup;
use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocess logic for dripyard_title fields.
 */
class DripyardTitle extends PreprocessBase {

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
    // Check if this is a dripyard_title field.
    return !empty($variables['content']['dripyard_title']);
  }

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $variables
   *   The variables to process.
   */
  public function preprocess(&$variables): void {
    $item = $variables['content']['dripyard_title'];

    if (!empty($item[0]['#text'])) {
      $value = $item[0]['#text'];

      // Replace adjacent closing and opening p tags with a line break
      $value = preg_replace('/<\/p>\s*<p>/s', '<br />', $value);

      // Then strip all remaining p tags
      $value = preg_replace('/<p>(.*?)<\/p>/s', '$1', $value);
      unset($item['content']['#pre_render']);

      // Store the stripped text as a prop.
      $variables['props']['dripyard_title'] = Markup::create($value);
    }

  }

}
