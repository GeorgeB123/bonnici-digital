<?php

namespace Drupal\dripyard_base\Preprocess\Block;

use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocesses blocks to handle region-specific logic.
 */
class RegionPreprocessor extends PreprocessBase {

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
    // This preprocessor applies to blocks that have an ID.
    return !empty($variables['elements']['#id']);
  }

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $variables
   *   The variables to process.
   */
  public function preprocess(&$variables): void {
    /** @var \Drupal\block\BlockInterface $block */
    $block = \Drupal::entityTypeManager()
      ->getStorage('block')
      ->load($variables['elements']['#id']);

    if ($block) {
      $region = $block->getRegion();

      // Add region to menu block attributes.
      if ($variables['base_plugin_id'] === 'system_menu_block') {
        $variables['content']['#attributes']['region'] = $region;
      }
    }
  }

}
