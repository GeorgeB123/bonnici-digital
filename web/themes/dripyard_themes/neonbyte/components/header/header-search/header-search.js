/**
 * @file
 * Search box interaction (at wide widths).
 */
((Drupal, once) => {
  let desktopSearchButton;
  let searchWrapper;
  let isSearchOpen;

  /**
   * Initializes everything.
   *
   * @param {Element} header - the <header> element.
   */
  function init(header) {
    desktopSearchButton = header.querySelector('.header-search__trigger');
    searchWrapper = header.querySelector('.header-search__content');
    isSearchOpen = () => desktopSearchButton.getAttribute('aria-expanded') === 'true';
    searchInput = searchWrapper.querySelector('[type="search"], [type="text"]');

    desktopSearchButton.addEventListener('click', () => {
      changeSearchVisibility(!isSearchOpen());
    });

    document.addEventListener('keyup', (e) => {
      if (e.key === 'Escape') {
        changeSearchVisibility(false);
      }
    });

    desktopSearchButton.addEventListener('focusout', handleSearchFocusOut, true);
    searchWrapper.addEventListener('focusout', handleSearchFocusOut, true);
  }


  /**
   * Closes the search wrapper when focus shifts away from the search wrapper
   * and search button.
   *
   * @param {Event} e - Focusout event object.
   */
  function handleSearchFocusOut(e) {
    if (Drupal.dripyard.isDesktopNav()) {
      if (!searchWrapper.contains(e.relatedTarget) && e.relatedTarget !== desktopSearchButton) {
        // In Safari (tested on v18.1) if the search button is clicked with a
        // mouse, the <button> element does not grab focus (Safari refuses to
        // fix this 🤬). This in turn causes the search wrapper to close, which
        // then causes Safari to not submit the form. It also does not activate
        // any `click` event on the <button> element. To work around this, we
        // add a small setTimeout.
        setTimeout(() => changeSearchVisibility(false), 200);
      }
    }
  }

  /**
   * Show/hide search.
   *
   * @param {boolean} toState
   */
  function changeSearchVisibility(toState) {
    const searchWrapperContainsFocus = searchWrapper.contains(document.activeElement);
    const searchInput = searchWrapper.querySelector('[type="search"], [type="text"]');

    searchWrapper.classList.toggle('is-active', toState);
    searchWrapper.classList.toggle('site-header__dropdown--active', toState);
    desktopSearchButton.setAttribute('aria-expanded', toState);

    if (toState === false && searchWrapperContainsFocus) {
      desktopSearchButton.focus();
    }

    if (toState === true) {
      Drupal.dripyard.closeAllSubNav?.();
      Drupal.dripyard.closeLanguageSwitcher?.();
      searchInput.focus();
    }
  }

  /**
   * Close search dropdown.
   */
  function closeSearch() {
    changeSearchVisibility(false);
  }
  Drupal.dripyard = Drupal.dripyard || {};
  Drupal.dripyard.closeSearch = closeSearch;

  Drupal.behaviors.headerSearch = {
    attach(context) {
      once('header-search-search', '.site-header:has([data-component-id="neonbyte:header-search"])', context).forEach(init);
    },
  };
})(Drupal, once);
