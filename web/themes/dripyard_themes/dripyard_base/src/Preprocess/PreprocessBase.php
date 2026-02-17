<?php

namespace Drupal\dripyard_base\Preprocess;

/**
 * Base class for preprocess logic.
 */
abstract class PreprocessBase implements PreprocessInterface {

  /**
   * The theme name.
   *
   * @var string
   */
  protected $theme;

  /**
   * {@inheritdoc}
   */
  public function setTheme(string $theme): void {
    $this->theme = $theme;
  }

  /**
   * {@inheritdoc}
   */
  public function getTheme(): string {
    return $this->theme;
  }

}
