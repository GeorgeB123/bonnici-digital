<?php

namespace Drupal\dripyard_base;

use Drupal\Core\Security\TrustedCallbackInterface;

/**
 * Implements trusted prerender callbacks.
 *
 * @internal
 */
class DripyardBasePrerender implements TrustedCallbackInterface {

  /**
   * Prerender callback for text_format elements.
   *
   * @param array<string, mixed> $element
   *   The element array.
   *
   * @return array<string, mixed>
   *   The modified element array.
   */
  public static function textFormat(array $element): array {
    $element['format']['#attributes']['class'][] = 'filter-wrapper';
    $element['format']['format']['#wrapper_attributes']['class'][] = 'form-item--editor-format';
    $element['format']['format']['#attributes']['class'][] = 'filter-list';
    $element['format']['format']['#attributes']['class'][] = 'form-element--small';
    $element['format']['format']['#attributes']['class'][] = 'form-element--editor-format';
    $element['format']['guidelines']['#attributes']['class'][] = 'filter-guidelines';
    $element['format']['help']['#attributes']['class'][] = 'filter-help';
    return $element;
  }

  /**
   * Prerender callback for status_messages placeholder.
   *
   * @param array<string, mixed> $element
   *   A renderable array.
   *
   * @return array<string, mixed>
   *   The updated renderable array containing the placeholder.
   */
  public static function messagePlaceholder(array $element) {
    if (isset($element['fallback']['#markup'])) {
      $element['fallback'] = [
        '#type' => 'inline_template',
        '#template' => '<div data-drupal-messages-fallback class="hidden messages-list"></div>',
      ];
    }
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function trustedCallbacks() {
    return [
      'textFormat',
      'messagePlaceholder',
    ];
  }

}
