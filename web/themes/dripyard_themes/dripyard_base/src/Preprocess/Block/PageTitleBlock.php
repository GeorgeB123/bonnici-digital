<?php

namespace Drupal\dripyard_base\Preprocess\Block;

use Drupal\node\NodeInterface;
use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocess Drupal's page title block.
 */
class PageTitleBlock extends PreprocessBase {

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $variables
   *   The variables to process.
   */
  public function preprocess(&$variables): void {
    /** @var \Drupal\Core\Routing\RouteMatchInterface */
    $route_match = \Drupal::routeMatch();
    $node = $route_match->getParameter('node');

    // Resolve the different parameter name in node preview.
    if ($route_match->getRouteName() == 'entity.node.preview') {
      $node = $route_match->getParameter('node_preview');
    }

    if ($node instanceof NodeInterface) {
      // Check if this node has the dripyard_hide_page_title field and it's enabled
      if ($node->hasField('dripyard_hide_page_title') && !$node->get('dripyard_hide_page_title')->isEmpty()) {
        // If the field value is true (1), hide the title
        if ($node->get('dripyard_hide_page_title')->value == 1) {
          $variables['content']['#access'] = FALSE;
        }
      }
      // For specific content types, always hide the title (no field check needed)
      elseif (in_array($node->bundle(), $this->noTitleBundles())) {
        $variables['content']['#access'] = FALSE;
      }
    }
  }

  /**
   * Define bundles that should never have a title.
   *
   * @return array<int, string>
   *   An array of bundle names that should not display a page title.
   */
  public function noTitleBundles() {
    return [];
  }

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
    return !empty($variables['plugin_id']) && $variables['plugin_id'] == 'page_title_block';
  }

}
