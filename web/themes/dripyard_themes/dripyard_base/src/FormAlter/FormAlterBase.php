<?php

namespace Drupal\dripyard_base\FormAlter;

use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a base class for form alters.
 */
abstract class FormAlterBase implements FormAlterInterface {

  /**
   * Form IDs this alter applies to.
   *
   * @var array<int, string>
   */
  protected $formIds = [];

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
    return in_array($form_id, $this->getFormIds());
  }

  /**
   * Gets the form IDs this alter applies to.
   *
   * @return array<int, string>
   *   The form IDs.
   */
  protected function getFormIds(): array {
    return $this->formIds;
  }

}
