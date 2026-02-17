<?php

namespace Drupal\dripyard_base\Preprocess\Block;

use Drupal\dripyard_base\ThemeSettings\SocialMediaLinks;
use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Preprocessor for the social media links block.
 */
class SocialMediaLinksBlock extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function preprocess(&$variables): void {
    $social_media_settings = new SocialMediaLinks();
    $social_media_link_properties = $social_media_settings->getSocialMediaLinkProperties();
    $config = (array) \Drupal::config($this->getTheme() . '.settings')->get('social_media_links');
    foreach ($config as $key => $item) {
      if (empty($item)) {
        continue;
      }
      $variables['social_media_links'][] = [
        'title' => $social_media_link_properties[$key]['label'],
        'icon' => $social_media_link_properties[$key]['icon'],
        'url' => $config[$key],
      ];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function applies($variables): bool {
    // Use the block ID to determine if this is the social media links block.
    return !empty($variables['elements']['#id']) && strpos($variables['elements']['#id'], 'dripyard_base_socialmedialinks') === 0;
  }

}
