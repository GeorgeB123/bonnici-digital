<?php

namespace Drupal\dripyard_base\Preprocess\Input;

/**
 * Preprocesses input elements to handle title attributes.
 */
class TitleAttributePreprocessor extends InputPreprocessorBase {

  /**
   * {@inheritdoc}
   */
  public function applies($variables): bool {
    $parent_applies = parent::applies($variables);

    return $parent_applies &&
      !empty($variables['element']['#title_display']) &&
      $variables['element']['#title_display'] === 'attribute' &&
      !empty((string) $variables['element']['#title']);
  }

  /**
   * {@inheritdoc}
   */
  public function preprocess(&$variables): void {
    // Set the title attribute from the element's title.
    $variables['attributes']['title'] = (string) $variables['element']['#title'];
  }

}
