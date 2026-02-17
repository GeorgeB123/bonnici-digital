/**
 * @file
 * Language switcher interaction (at wide widths).
 */
((Drupal, once) => {
  let desktopSwitcherButton;
  let switcherWrapper;
  let isOpen;

  /**
   * Initializes everything.
   *
   * @param {Element} el - the language switcher element.
   */
  function init(el) {
    desktopSwitcherButton = el.querySelector('.language-switcher__trigger');
    switcherWrapper = el.querySelector('.language-switcher__content');
    isOpen = () => desktopSwitcherButton.getAttribute('aria-expanded') === 'true';

    desktopSwitcherButton.addEventListener('click', () => {
      changeSwitcherVisibility(!isOpen());
    });

    document.addEventListener('keyup', (e) => {
      if (e.key === 'Escape') {
        changeSwitcherVisibility(false);
      }
    });

    desktopSwitcherButton.addEventListener('focusout', handleSwitcherFocusOut, true);
    switcherWrapper.addEventListener('focusout', handleSwitcherFocusOut, true);
  }


  /**
   * Closes the language switcher wrapper when focus shifts away from the language switcher wrapper
   * and language switcher button.
   *
   * @param {Event} e - Focusout event object.
   */
  function handleSwitcherFocusOut(e) {
    if (Drupal.dripyard.isDesktopNav()) {
      if (!switcherWrapper.contains(e.relatedTarget) && e.relatedTarget !== desktopSwitcherButton) {
        // In Safari (tested on v18.1) if the switcher button is clicked with a
        // mouse, the <button> element does not grab focus (Safari refuses to
        // fix this 🤬). This in turn causes the switcher wrapper to close, which
        // then causes Safari to not submit the form. It also does not activate
        // any `click` event on the <button> element. To work around this, we
        // add a small setTimeout.
        setTimeout(() => changeSwitcherVisibility(false), 200);
      }
    }
  }

  /**
   * Show/hide the language switcher.
   *
   * @param {boolean} toState
   */
  function changeSwitcherVisibility(toState) {
    const switcherWrapperContainsFocus = switcherWrapper.contains(document.activeElement);

    switcherWrapper.classList.toggle('is-active', toState);
    switcherWrapper.classList.toggle('site-header__dropdown--active', toState);
    desktopSwitcherButton.setAttribute('aria-expanded', toState);

    if (toState === true) {
      Drupal.dripyard.closeAllSubNav?.();
      Drupal.dripyard.closeSearch?.();
    }
  }

  /**
   * Close language switcher.
   */
  function closeLanguageSwitcher() {
    changeSwitcherVisibility(false);
  }
  Drupal.dripyard = Drupal.dripyard || {};
  Drupal.dripyard.closeLanguageSwitcher = closeLanguageSwitcher;

  Drupal.behaviors.languageSwitcher = {
    attach(context) {
      once('language-switcher', '.language-switcher', context).forEach(init);
    },
  };
})(Drupal, once);
