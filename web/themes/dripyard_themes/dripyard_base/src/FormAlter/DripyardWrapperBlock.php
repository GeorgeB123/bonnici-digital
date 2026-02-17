<?php

namespace Drupal\dripyard_base\FormAlter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\dripyard_base\Utility\DripyardPropsForm;

/**
 * Alters search forms to add placeholder text and classes.
 */
class DripyardWrapperBlock extends FormAlterBase {

  /**
   * Whether the form is in layout builder context.
   *
   * @var bool
   */
  private $isLayoutBuilder = FALSE;

  /**
   * {@inheritdoc}
   *
   * @var array<int, string>
   */
  protected $formIds = [
    'layout_builder_add_block',
    'layout_builder_update_block',
    'block_content_dripyard_wrapper_form',
    'block_content_dripyard_wrapper_edit_form',
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
   *
   * @return bool
   *   TRUE if the form alter applies.
   */
  public function applies(array &$form, FormStateInterface $form_state, $form_id): bool {
    if (parent::applies($form, $form_state, $form_id)) {
      $block = $this->getBlockFromForm($form, $form_state);
      if ($block && $block->bundle() === 'dripyard_wrapper') {
        return TRUE;
      }
    }
    return FALSE;
  }

  /**
   * Get the block entity from the form structure.
   *
   * @param array<string, mixed> $form
   *   The form array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return \Drupal\block_content\Entity\BlockContent|null
   *   The block entity or NULL if not found.
   */
  private function getBlockFromForm(array &$form, FormStateInterface $form_state) {
    // For layout builder forms (add/update block)
    if (!empty($form['settings']['block_form']['#block'])) {
      $this->isLayoutBuilder = TRUE;
      return $form['settings']['block_form']['#block'];
    }

    // For direct block edit forms
    $form_object = $form_state->getFormObject();
    if ($form_object && method_exists($form_object, 'getEntity')) {
      $entity = $form_object->getEntity();
      if ($entity && $entity->getEntityTypeId() === 'block_content') {
        $this->isLayoutBuilder = FALSE;
        return $entity;
      }
    }

    return NULL;
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
    $block = $this->getBlockFromForm($form, $form_state);

    if (!$block) {
      return;
    }

    $props_json = $block->get('dripyard_wrapper_props')->value;
    $props = !empty($props_json) ? json_decode($props_json, TRUE) : [];

    // Get options from the dripyard_wrapper field definition
    $field_definition = $block->getFieldDefinition('dripyard_wrapper');
    $wrapper_options = $field_definition ? $field_definition->getSetting('allowed_values') : [];

    // Add our own form element so that we can attach ajax to it. This could
    // not be accomplished using the block form that get's embedded, so we
    // hide all the fields on the Block UI form config.
    $form['wrapper_selector'] = [
      '#type' => 'select',
      '#title' => t('Wrapper Type'),
      '#options' => $wrapper_options,
      '#default_value' => $block->get('dripyard_wrapper')->value,
      '#ajax' => [
        'callback' => [$this, 'ajaxUpdateProps'],
        'wrapper' => 'props-wrapper',
        'event' => 'change',
      ],
      '#weight' => -10,
    ];

    // Load the selected wrapper component schema via the Single Directory Components API.
    // Priority: form_state value from AJAX > current field value > first option as fallback
    $wrapper_type = $form_state->getValue('wrapper_selector') ??
      $block->get('dripyard_wrapper')->value ??
      (!empty($wrapper_options) ? array_key_first($wrapper_options) : NULL);

    // Build the props form from the selected component.
    $props_form_builder = new DripyardPropsForm();
    $props_form_builder->setComponent($wrapper_type);
    $props_elements = $props_form_builder->buildFormElements($props);

    $form['props'] = [
      '#type' => 'details',
      '#title' => t('Props'),
      '#open' => TRUE,
      '#tree' => TRUE,
      '#prefix' => '<div id="props-wrapper">',
      '#suffix' => '</div>',
    ] + $props_elements;

    $form['actions']['#weight'] = 10;

    // Add submit handler based on context
    if ($this->isLayoutBuilder) {
      // Layout builder forms use form-level submit handlers
      array_unshift($form['#submit'], [$this, 'submit']);
    }
    else {
      // Direct block edit forms use action-level submit handlers
      if (isset($form['actions']['submit']['#submit'])) {
        array_unshift($form['actions']['submit']['#submit'], [$this, 'submit']);
      }
    }
  }

  /**
   * Submit callback for saving the form props.
   *
   * @param array<string, mixed> $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function submit(array &$form, FormStateInterface $form_state): void {
    $block = $this->getBlockFromForm($form, $form_state);

    if (!$block) {
      return;
    }
    $props = $form_state->getValue('props') ?: [];
    $wrapper_type = $form_state->getValue('wrapper_selector');

    if (!$wrapper_type) {
      return;
    }

    // Convert form values to proper types using utility class
    if (!empty($props) && is_array($props) && isset($form['props'])) {
      $props_form_builder = new DripyardPropsForm();
      $props_form_builder->setComponent($wrapper_type);
      $props_elements = $props_form_builder->buildFormElements();
      $props = $props_form_builder->convertFormValues($props_elements, $props);
    }

    $block->set('dripyard_wrapper_props', json_encode($props));
    $block->set('dripyard_wrapper', $wrapper_type);
  }

  /**
   * Ajax callback for refreshing the props form element.
   *
   * @param array<string, mixed> $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return array<string, mixed>
   *   The props form element.
   */
  public function ajaxUpdateProps(array &$form, FormStateInterface $form_state): array {
    // Return the rebuilt props element (Drupal handles the rebuild via alter())
    return $form['props'];
  }

}
