<?php

namespace Drupal\dripyard_base\ThemeSettings;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\dripyard_base\Interface\WeightedInterface;
use GuzzleHttp\Exception\RequestException;
use Drupal\Component\Utility\Xss;

/**
 * Provides branding information and support links for Dripyard.
 */
class DripyardSupport extends ThemeSettingsBase implements WeightedInterface {
  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public static function getWeight(): int {
    return 0;
  }

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function themeSettingsFormAlter(&$form, FormStateInterface $form_state): void {
    parent::themeSettingsFormAlter($form, $form_state);
    if (!isset($form['dripyard'])) {
      $form['dripyard'] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['dripyard-theme-settings'],
        ],
        '#weight' => -100,
      ];
    }

    $form['#attached']['library'][] = 'dripyard_base/theme-settings';

    $theme_name = ucwords($this->getTheme());

    $form['dripyard']['header'] = [
      '#markup' =>
      '<div class="dripyard-theme-settings__header">'
      . '<div class="dripyard-theme-settings__top">'
      . '<img class="dripyard-theme-settings__logo" src="https://m.dripyard.com/logo.svg" alt="Dripyard Company Logo" width="350" />'
      . '</div>'
      . '<div class="dripyard-theme-settings__bottom">'
      . '<h2 class="dripyard-theme-settings__title">' . $this->t('@theme Theme Settings', ['@theme' => $theme_name]) . '</h2>'
      . '<div class="dripyard-theme-settings__subtitle">' . $this->t('Configure and customize your theme.') . '</div>'
      . '</div>'
      . '</div>',
    ];

    // Add license information as a collapsible fieldset if available.
    $license_data = $this->getLicenseData();
    if ($license_data) {
      $form['dripyard']['license_info'] = [
        '#type' => 'details',
        '#title' => $this->t('License Information'),
        '#open' => FALSE,
        '#attributes' => [
          'class' => ['dripyard-theme-settings__license'],
        ],
      ];

      foreach ($license_data as $key => $data) {
        if ($key === 'message') {
          if (!empty($data)) {
            $form['dripyard']['license_info']['dripyard_message'] = [
              '#markup' => '<div class="dripyard-license-message">' . $data . '</div>',
            ];
          }
        }
        else {
          $form['dripyard']['license_info'][$key] = [
            '#markup' => '<div><strong>' . $data['label'] . ':</strong> ' . $data['value'] . '</div>',
          ];
        }
      }
    }

  }

  /**
   * Gets license data from theme configuration and validates it.
   *
   * @return array<string, mixed>|null
   *   The license information data array or null if not available.
   */
  protected function getLicenseData(): ?array {
    // Load theme configuration.
    $config = \Drupal::config($this->getTheme() . '.settings');

    $license_uuid = $config->get('license_uuid');
    $dripyard_uid = $config->get('dripyard_uid');

    if (empty($license_uuid) || empty($dripyard_uid)) {
      return NULL;
    }

    try {
      // Make HTTP request to validate license.
      $url = "https://packages.dripyard.com/api/customer/{$dripyard_uid}/license/{$license_uuid}";
      $http_client = \Drupal::httpClient();
      $response = $http_client->request('GET', $url, [
        'timeout' => 10,
        'headers' => [
          'Accept' => 'application/json',
        ],
      ]);

      $data = json_decode($response->getBody()->getContents(), TRUE);

      if (isset($data['license'])) {
        $license = $data['license'];
        $theme_name = $license['themeName'] ?? 'Unknown';
        $license_uuid_display = $license['licenseUuid'] ?? 'Unknown';
        $date_expired = $license['dateExpired'] ?? 'Unknown';
        $date_granted = $license['dateGranted'] ?? 'Unknown';
        $email = $license['email'] ?? 'Unknown';
        $dripyard_message = $data['dripyardMessage'] ?? '';

        // Format the expiration date.
        if ($date_expired !== 'Unknown') {
          $date = \DateTime::createFromFormat('Y-m-d H:i:s', $date_expired);
          if ($date) {
            $date_expired = $date->format('F j, Y');
          }
        }

        // Format the purchase date.
        if ($date_granted !== 'Unknown') {
          $date = \DateTime::createFromFormat('Y-m-d H:i:s', $date_granted);
          if ($date) {
            $date_granted = $date->format('F j, Y');
          }
        }

        return [
          'theme' => ['label' => $this->t('Theme'), 'value' => Xss::filter($theme_name)],
          'license_id' => ['label' => $this->t('License ID'), 'value' => Xss::filter($license_uuid_display)],
          'purchased_by' => ['label' => $this->t('Purchased By'), 'value' => Xss::filter($email)],
          'purchase_date' => ['label' => $this->t('Purchase Date'), 'value' => htmlspecialchars($date_granted)],
          'support_until' => ['label' => $this->t('Advanced Support Until'), 'value' => htmlspecialchars($date_expired)],
          'message' => $dripyard_message ? Xss::filter($dripyard_message, ['p', 'b', 'strong', 'i', 'em', 'a', 'br']) : '',
        ];
      }
    }
    catch (RequestException $e) {
      // Log the error but don't display it to avoid exposing sensitive info.
      \Drupal::logger('dripyard_base')->error('Failed to validate license: @message', [
        '@message' => $e->getMessage(),
      ]);
    }
    catch (\Exception $e) {
      \Drupal::logger('dripyard_base')->error('License validation error: @message', [
        '@message' => $e->getMessage(),
      ]);
    }

    return NULL;
  }

}
