/**
 * @file
 * Cart dropdown interaction (at wide widths).
 */
((Drupal, once) => {
  let cartButton;
  let cartWrapper;
  let isDropdownOpen;

  /**
   * Initializes everything.
   *
   * @param {Element} header - the <header> element.
   */
  function init(header) {
    cartButton = header.querySelector('button.header-commerce-cart__link');

    // If no cart, then return.
    if (!cartButton) return;

    cartWrapper = header.querySelector('.header-commerce-cart__dropdown');
    isDropdownOpen = () => cartButton.getAttribute('aria-expanded') === 'true';

    cartButton.addEventListener('click', () => {
      changeDropdownVisibility(!isDropdownOpen());
    });

    document.addEventListener('keyup', (e) => {
      if (e.key === 'Escape') {
        changeDropdownVisibility(false);
      }
    });

    cartButton.addEventListener('focusout', handleFocusOut, true);
    cartWrapper.addEventListener('focusout', handleFocusOut, true);
  }


  /**
   * Closes the search wrapper when focus shifts away from the search wrapper
   * and search button.
   *
   * @param {Event} e - Focusout event object.
   */
  function handleFocusOut(e) {
    if (Drupal.dripyard.isDesktopNav()) {
      if (!cartWrapper.contains(e.relatedTarget) && e.relatedTarget !== cartButton) {
        // In Safari (tested on v18.1) if the search button is clicked with a
        // mouse, the <button> element does not grab focus (Safari refuses to
        // fix this 🤬). This in turn causes the search wrapper to close, which
        // then causes Safari to not submit the form. It also does not activate
        // any `click` event on the <button> element. To work around this, we
        // add a small setTimeout.
        setTimeout(() => changeDropdownVisibility(false), 200);
      }
    }
  }

  /**
   * Show/hide search.
   *
   * @param {boolean} toState
   */
  function changeDropdownVisibility(toState) {
    const cartWrapperContainsFocus = cartWrapper.contains(document.activeElement);

    cartButton.setAttribute('aria-expanded', toState);

    if (toState === false && cartWrapperContainsFocus) {
      cartButton.focus();
    }

    if (toState === true) {
      Drupal.dripyard.closeAllSubNav?.();
      Drupal.dripyard.closeLanguageSwitcher?.();
    }
  }

  /**
   * Close search dropdown.
   */
  function closeCart() {
    changeDropdownVisibility(false);
  }
  Drupal.dripyard = Drupal.dripyard || {};
  Drupal.dripyard.closeCart = closeCart;

  Drupal.behaviors.headerCommerceCart = {
    attach(context) {
      once('headerCommerceCart', '.header-commerce-cart', context).forEach(init);
    },
  };
})(Drupal, once);
