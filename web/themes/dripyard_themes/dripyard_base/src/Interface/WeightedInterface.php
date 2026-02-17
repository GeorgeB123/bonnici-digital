<?php

namespace Drupal\dripyard_base\Interface;

/**
 * Interface for classes that can be weighted for execution order.
 */
interface WeightedInterface {

  /**
   * Gets the weight of this class for sorting purposes.
   *
   * Lower weights are executed first.
   *
   * Common weight conventions:
   * - Critical/early processing: -100 to -10
   * - Normal processing: -10 to 10 (default: 0)
   * - Late processing: 10 to 100
   *
   * @return int
   *   The weight of the class.
   */
  public static function getWeight(): int;

}
