<?php

namespace Drupal\dripyard_base\FormAlter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Alters user login form to enhance UX.
 */
class UserLoginFormAlter extends FormAlterBase {

  /**
   * {@inheritdoc}
   *
   * @var array<int, string>
   */
  protected $formIds = [
    'user_login_form',
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
    // Remove default field descriptions.
    unset($form['name']['#description']);
    unset($form['pass']['#description']);

    // Set translated button label.
    $form['actions']['submit']['#value'] = t('Login');
    $form['actions']['submit']['#attributes']['class'][] = 'user-login-form__login-link';

    $password_link = Link::fromTextAndUrl(
      t('Forgot password?'),
      Url::fromRoute('user.pass')
    )->toString();

    // Conditionally show "Create Account" link based on user settings.
    $register_setting = \Drupal::config('user.settings')->get('register');
    $register_link_render = [];
    if ($register_setting === 'visitors') {
      $register_link_render = Link::fromTextAndUrl(
        t('Create Account'),
        Url::fromRoute('user.register')
      )->toRenderable();
      $register_link_render['#attributes']['class'][] = 'button user-login-form__register-link';
    }

    $form['login_links'] = [
      '#type' => 'container',
      '#attributes' => ['class' => ['user-login-form__links']],
      'register' => $register_link_render,
      'forgot' => [
        '#markup' => '<div class="user-login-form__pass-link">' . $password_link . '</div>',
      ],
      '#weight' => 100,
    ];

    $form['#attached']['library'][] = 'dripyard_base/user-login-form';
    $form['#attributes']['class'][] = 'user-login-form';
  }

}
