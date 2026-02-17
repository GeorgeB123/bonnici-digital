<?php

namespace Drupal\neonbyte\Preprocess\Block;

use Drupal\dripyard_base\Preprocess\Block\PageTitleBlock as BlockPageTitleBlock;

/**
 * Extends the page title block preprocessor to override no title bundles.
 */
class PageTitleBlock extends BlockPageTitleBlock {

  /**
   * {@inheritdoc}
   *
   * @return array<string>
   */
  public function noTitleBundles() {
    return [
      'article',
    ];
  }

}
