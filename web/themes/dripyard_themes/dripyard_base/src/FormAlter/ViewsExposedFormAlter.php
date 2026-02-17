<?php

namespace Drupal\dripyard_base\FormAlter;

use Drupal\Core\Form\FormStateInterface;

/**
 * Alters views exposed forms to improve alignment.
 */
class ViewsExposedFormAlter extends FormAlterBase {

  /**
   * {@inheritdoc}
   *
   * @var array<int, string>
   */
  protected $formIds = [
    'views_exposed_form',
  ];

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
    // Add empty div with label CSS class to ensure that the submit button
    // horizontally aligns with form elements in all cases.
    $form['actions']['empty_label'] = [
      '#allowed_tags' => ['label'],
      '#markup' => '<label class="form-item__label visibility-hidden">&nbsp;</label>',
      '#weight' => -10,
    ];
  }

}
