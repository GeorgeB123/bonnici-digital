<?php

namespace Drupal\dripyard_base\FormAlter;

use Drupal\Core\Form\FormStateInterface;

/**
 * Alters search forms to add placeholder text and classes.
 */
class SearchFormAlter extends FormAlterBase {

  /**
   * {@inheritdoc}
   *
   * @var array<int, string>
   */
  protected $formIds = [
    'search_block_form',
    'search_form',
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
    switch ($form_id) {
      case 'search_block_form':
        // Add placeholder text to keys input.
        $form['keys']['#attributes']['placeholder'] = t('Search by keyword or phrase.');

        // Add classes to the search form submit input.
        $form['actions']['submit']['#attributes']['class'][] = 'search-form__submit';
        break;

      case 'search_form':
        $form['basic']['keys']['#attributes']['placeholder'] = t('Search by keyword or phrase.');
        $form['basic']['submit']['#attributes']['class'][] = 'button--primary';
        $form['advanced']['submit']['#attributes']['class'][] = 'button--primary';
        break;
    }
  }

}
