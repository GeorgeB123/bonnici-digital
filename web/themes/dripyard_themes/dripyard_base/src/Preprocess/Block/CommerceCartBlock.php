<?php

namespace Drupal\dripyard_base\Preprocess\Block;

use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocess Commerce's cart block.
 */
class CommerceCartBlock extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function applies(array $variables): bool {
    return isset($variables['plugin_id']) && $variables['plugin_id'] === 'commerce_cart';
  }

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $variables
   *   The variables to process.
   */
  public function preprocess(&$variables): void {
    if (isset($variables['content']['#links'])) {
      foreach ($variables['content']['#links'] as &$link) {
        // Add dripyard_base:button SDC component to all links.
        $props = [
          'text' => $link['#title'],
          'href' => $link['#url']->toString(),
          'size' => 'small',
        ];

        // Add extra props if link text contains 'cart'.
        if (stripos($link['#title'], 'cart') !== FALSE) {
          $props['style'] = 'primary';
          $props['suffix_icon'] = 'cart-shopping';
        }

        $link['#title'] = [
          'button' => [
            '#type' => 'component',
            '#component' => 'dripyard_base:button',
            '#props' => $props,
          ],
        ];
      }
    }
  }

}
