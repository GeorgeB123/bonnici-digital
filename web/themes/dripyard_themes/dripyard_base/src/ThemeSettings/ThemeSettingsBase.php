<?php

namespace Drupal\dripyard_base\ThemeSettings;

use Drupal\Core\Form\FormStateInterface;

/**
 * Base class for all theme settings.
 */
abstract class ThemeSettingsBase {
  /**
   * Defines the theme name.
   *
   * @var string
   */
  public $theme;

  /**
   * Sets the theme name.
   *
   * @param string $theme
   *   The theme name.
   */
  public function setTheme($theme): void {
    $this->theme = $theme;
  }

  /**
   * Gets the theme name.
   *
   * @return string
   *   The theme name.
   */
  public function getTheme() {
    return $this->theme;
  }

  /**
   * The theme settings form alter base method.
   *
   * @param array<string, mixed> $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function themeSettingsFormAlter(array &$form, FormStateInterface $form_state): void {
    if (!$form_state->has('theme_name')) {
      $form_state->set('theme_name', $this->getTheme());
    }
  }

}
