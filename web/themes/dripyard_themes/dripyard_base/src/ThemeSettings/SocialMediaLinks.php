<?php

namespace Drupal\dripyard_base\ThemeSettings;

use Drupal\Core\Form\FormStateInterface;

/**
 * Provides form and theme settings for social media links.
 */
class SocialMediaLinks extends ThemeSettingsBase {

  /**
   * The theme settings form alter.
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function themeSettingsFormAlter(array &$form, FormStateInterface $form_state): void {
    parent::themeSettingsFormAlter($form, $form_state);
    $form['social_media_links'] = [
      '#type' => 'details',
      '#open' => FALSE,
      '#tree' => TRUE,
      '#title' => t('Social Media Links'),
      '#description' => t('Enter the URLs for your social media profiles.'),
    ];

    $config = \Drupal::config($this->getTheme() . '.settings')->get('social_media_links');

    foreach (static::getSocialMediaLinkProperties() as $key => $item) {
      $form['social_media_links'][$key] = [
        '#type' => 'textfield',
        '#title' => $item['label'],
        '#default_value' => $config[$key] ?? '',
      ];
    }

    $form['#submit'][] = [self::class, 'submitSocialMediaSettings'];
  }

  /**
   * Submit callback to save the settings.
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public static function submitSocialMediaSettings(array &$form, FormStateInterface $form_state): void {
    $values = $form_state->getValue('social_media_links');
    $theme = $form_state->get('theme_name');
    \Drupal::configFactory()->getEditable($theme . '.settings')
      ->set('social_media_links', $values)
      ->save();
  }

  /**
   * Loads the available social media link properties.
   *
   * @return array<string, array<string, mixed>>
   *   The social media link properties.
   */
  public static function getSocialMediaLinkProperties() {
    return [
      'bluesky' => [
        'label' => t('BlueSky'),
        'icon' => 'bluesky',
      ],
      'discord' => [
        'label' => t('Discord'),
        'icon' => 'discord',
      ],
      'facebook' => [
        'label' => t('Facebook'),
        'icon' => 'facebook',
      ],
      'github' => [
        'label' => t('GitHub'),
        'icon' => 'github',
      ],
      'instagram' => [
        'label' => t('Instagram'),
        'icon' => 'instagram',
      ],
      'linkedin' => [
        'label' => t('LinkedIn'),
        'icon' => 'linkedin',
      ],
      'mastodon' => [
        'label' => t('Mastodon'),
        'icon' => 'mastodon',
      ],
      'pinterest' => [
        'label' => t('Pinterest'),
        'icon' => 'pinterest',
      ],
      'reddit' => [
        'label' => t('Reddit'),
        'icon' => 'reddit',
      ],
      'snapchat' => [
        'label' => t('Snapchat'),
        'icon' => 'snapchat',
      ],
      'telegram' => [
        'label' => t('Telegram'),
        'icon' => 'telegram',
      ],
      'threads' => [
        'label' => t('Threads'),
        'icon' => 'threads',
      ],
      'tiktok' => [
        'label' => t('TikTok'),
        'icon' => 'tiktok',
      ],
      'twitch' => [
        'label' => t('Twitch'),
        'icon' => 'twitch',
      ],
      'twitter' => [
        'label' => t('X'),
        'icon' => 'x-twitter',
      ],
      'whatsapp' => [
        'label' => t('WhatsApp'),
        'icon' => 'whatsapp',
      ],
      'youtube' => [
        'label' => t('YouTube'),
        'icon' => 'youtube',
      ],
    ];
  }

}
