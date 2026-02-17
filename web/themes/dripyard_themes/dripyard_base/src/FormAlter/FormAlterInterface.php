<?php

namespace Drupal\dripyard_base\FormAlter;

use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an interface to abstract form alter logic.
 */
interface FormAlterInterface {

  /**
   * Determines if the form alter should apply.
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   * @param string $form_id
   *   The form ID.
   *
   * @return bool
   *   TRUE if the form alter should apply, FALSE otherwise.
   */
  public function applies(array &$form, FormStateInterface $form_state, $form_id): bool;

  /**
   * Alters the form.
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   * @param string $form_id
   *   The form ID.
   */
  public function alter(array &$form, FormStateInterface $form_state, $form_id): void;

}
