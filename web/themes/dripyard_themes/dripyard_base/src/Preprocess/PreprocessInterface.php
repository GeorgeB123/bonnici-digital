<?php

namespace Drupal\dripyard_base\Preprocess;

/**
 * Provides an interface to abstract the preprocess logic.
 */
interface PreprocessInterface {

  /**
   * Determines if the preprocess should apply.
   *
   * @param array<string, mixed> $variables
   *   The variables.
   *
   * @return bool
   *   TRUE if the preprocess should apply, FALSE otherwise.
   */
  public function applies(array $variables): bool;

  /**
   * Processes the variables.
   *
   * @param array<string, mixed> $variables
   *   The variables to process.
   */
  public function preprocess(array &$variables): void;

  /**
   * Sets the theme.
   *
   * @param string $theme
   *   The theme.
   */
  public function setTheme(string $theme): void;

  /**
   * Gets the theme.
   *
   * @return string
   *   The theme.
   */
  public function getTheme(): string;

}
