<?php

namespace Drupal\dripyard_base\Preprocess\PageTitle;

use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocesses page title elements to handle shortcuts.
 */
class ShortcutProcessor extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function applies($variables): bool {
    // This preprocessor applies to page titles.
    return isset($variables['title']);
  }

  /**
   * {@inheritdoc}
   */
  public function preprocess(&$variables): void {
    // Since the title and the shortcut link are both block level elements,
    // positioning them next to each other is much simpler with a wrapper div.
    if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
      // Add a wrapper div using the title_prefix and title_suffix render
      // elements.
      $variables['title_prefix']['shortcut_wrapper'] = [
        '#markup' => '<div class="shortcut-wrapper">',
        '#weight' => 100,
      ];
      $variables['title_suffix']['shortcut_wrapper'] = [
        '#markup' => '</div>',
        '#weight' => -99,
      ];

      // Make sure the shortcut link is the first item in title_suffix.
      $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
    }

    // Unset shortcut link on front page.
    $variables['is_front'] = \Drupal::service('path.matcher')->isFrontPage();
    if ($variables['is_front'] === TRUE) {
      unset($variables['title_suffix']['add_or_remove_shortcut']);
    }
  }

}
