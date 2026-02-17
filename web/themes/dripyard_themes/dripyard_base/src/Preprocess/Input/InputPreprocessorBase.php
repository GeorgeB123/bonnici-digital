<?php

namespace Drupal\dripyard_base\Preprocess\Input;

use Drupal\dripyard_base\Preprocess\PreprocessBase;

/**
 * Base class for input element preprocessors.
 */
abstract class InputPreprocessorBase extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function applies($variables): bool {
    // Check if this is an input element.
    return isset($variables['element']['#type']) && isset($variables['attributes']['type']);
  }

}
