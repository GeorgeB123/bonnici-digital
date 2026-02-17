<?php

namespace Drupal\dripyard_base\Preprocess\Input;

use Drupal\Component\Utility\Html;

/**
 * Preprocesses boolean input elements (checkbox, radio) to add appropriate classes.
 */
class BooleanInputPreprocessor extends InputPreprocessorBase {

  /**
   * {@inheritdoc}
   */
  public function applies($variables): bool {
    $parent_applies = parent::applies($variables);

    if (!$parent_applies) {
      return FALSE;
    }

    // List of HTML input types that are considered boolean inputs.
    $boolean_types_html = ['checkbox', 'radio'];

    // Check if this input has one of our boolean types.
    return in_array($variables['attributes']['type'], $boolean_types_html, TRUE);
  }

  /**
   * {@inheritdoc}
   */
  public function preprocess(&$variables): void {
    $type_html = $variables['attributes']['type'];

    // Add appropriate classes to boolean input elements.
    $variables['attributes']['class'][] = 'form-boolean';
    $variables['attributes']['class'][] = Html::getClass('form-boolean--type-' . $type_html);
  }

}
