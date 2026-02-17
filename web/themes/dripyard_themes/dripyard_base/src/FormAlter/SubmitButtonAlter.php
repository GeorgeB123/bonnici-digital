<?php

namespace Drupal\dripyard_base\FormAlter;

use Drupal\Core\Form\FormStateInterface;

/**
 * Adds primary button class to submit buttons.
 */
class SubmitButtonAlter implements FormAlterInterface {

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   * @param string $form_id
   *   The form ID.
   *
   * @return bool
   *   TRUE if the form alter applies.
   */
  public function applies(array &$form, FormStateInterface $form_state, $form_id): bool {
    return isset($form['actions']['submit']) && (count($form['actions'])) <= 2;
  }

  /**
   * {@inheritdoc}
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   * @param string $form_id
   *   The form ID.
   */
  public function alter(array &$form, FormStateInterface $form_state, $form_id): void {
    $form['actions']['submit']['#attributes']['class'][] = 'button--primary';
  }

}
