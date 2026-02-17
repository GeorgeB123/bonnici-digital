/**
 * @file
 * Side menu interactions.
 */
((Drupal, once) => {

  function toggleButtonState({ currentTarget: button }) {
    const currentState = button.getAttribute('aria-expanded') === 'true';
    button.setAttribute('aria-expanded', !currentState);
  }

  function init(el) {
    // Set aria-expanded to true if menu is expanded by default.
    el.querySelectorAll('.default-menu__list-item--has-children').forEach(listItem => {
      const directNestedMenu = listItem.querySelector('.default-menu__list');

      if (directNestedMenu.clientHeight > 0) {
        listItem.querySelector('[aria-expanded]')?.setAttribute('aria-expanded', true);
      }
    });

    el.querySelectorAll('[aria-expanded]').forEach(el => el.addEventListener('click', toggleButtonState));

  }

  Drupal.behaviors.sideMenu = {
    attach(context) {
      once('side-menu', '.side-menu', context).forEach(init);
    },
  };
})(Drupal, once);
