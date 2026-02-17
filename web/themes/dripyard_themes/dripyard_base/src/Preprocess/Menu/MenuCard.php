<?php

namespace Drupal\dripyard_base\Preprocess\Menu;

use Drupal\views\Views;
use Drupal\menu_link_content\Plugin\Menu\MenuLinkContent;
use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocess logic for menu cards.
 */
class MenuCard extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function preprocess(&$variables): void {
    foreach ($variables["items"] as &$item) {
      if (!empty($item['original_link']) && $item['original_link'] instanceof MenuLinkContent) {
        $id = $item['original_link']->getEntity()->id();
        $view = Views::getView('dripyard_menu_cards');
        if ($view) {
          $view->setDisplay('default');
          $view->setArguments([$id]);
          $view->execute();
          $view_render = views_embed_view('dripyard_menu_cards', 'default', $id);
          $item['menu_cards'] = $view_render ? $view_render : '';
        }
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function applies($variables): bool {
    return TRUE;
  }

}
