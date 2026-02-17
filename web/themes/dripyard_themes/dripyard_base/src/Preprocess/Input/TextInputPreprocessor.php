<?php

namespace Drupal\dripyard_base\Preprocess\Input;

use Drupal\Component\Utility\Html;

/**
 * Preprocesses text input elements to add appropriate classes.
 */
class TextInputPreprocessor extends InputPreprocessorBase {

  /**
   * {@inheritdoc}
   */
  public function applies($variables): bool {
    $parent_applies = parent::applies($variables);

    if (!$parent_applies) {
      return FALSE;
    }

    // List of HTML input types that are considered text inputs.
    $text_types_html = [
      'text',
      'email',
      'tel',
      'number',
      'search',
      'password',
      'date',
      'time',
      'file',
      'color',
      'datetime-local',
      'url',
      'month',
      'week',
    ];

    // Check if this input has one of our text types.
    return in_array($variables['attributes']['type'], $text_types_html, TRUE);
  }

  /**
   * {@inheritdoc}
   */
  public function preprocess(&$variables): void {
    $type_api = $variables['element']['#type'];
    $type_html = $variables['attributes']['type'];

    // Add appropriate classes to text input elements.
    $variables['attributes']['class'][] = 'form-element';
    $variables['attributes']['class'][] = Html::getClass('form-element--type-' . $type_html);
    $variables['attributes']['class'][] = Html::getClass('form-element--api-' . $type_api);

    // Handle autocomplete message.
    if (!empty($variables['element']['#autocomplete_route_name'])) {
      $variables['autocomplete_message'] = t('Loading…');
    }
  }

}
