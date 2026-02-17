((Drupal) => {
  const siteHeader = document.querySelector('.site-header');
  const mobileNavigationButton = document.querySelector('[data-drupal-selector="mobile-nav-button"]');
  Drupal.dripyard = Drupal.dripyard || {};

  /**
   * A selector that will return all focusable elements.
   */
  Drupal.dripyard.focusableElementsSelector = ':is(audio, button, canvas, details, iframe, input, select, summary, textarea, video, [accesskey], [contenteditable], [href], [tabindex]:not([tabindex*="-"])):not(:is([disabled], [inert]))';

  /**
   * Determines if the mobile navigation is open by checking if its
   * disclosure button is visible.
   *
   * @returns {boolean}
   */
  function isDesktopNav() {
    return mobileNavigationButton.clientHeight === 0;
  }
  Drupal.dripyard.isDesktopNav = isDesktopNav;

  /**
   * Observe the mobileNavButton to determine if we enter mobile navigation mode.
   * When we do, toggle the `.theme--dark` CSS class on the navigation flyout, so
   * we can have correctly colored text and links. Also toggle it off when
   * we get back to desktop mode.
   */
  const navWrapper = siteHeader.querySelector('[data-drupal-selector="header-navigation-wrapper"]');
  const mobileNavObserver = new ResizeObserver((entries) => {
    entries.forEach(() => {
      navWrapper.classList.toggle('theme--black', !isDesktopNav());
    })
  });
  mobileNavObserver.observe(mobileNavigationButton);

  /**
   * Observe the site header for any attribute changes. If it sees CSS class
   * changes on the dropdown, it will get the height of the dropdown and
   * add a custom property to the siteHeader that's used to expand its height.
   *
   * If adding additional items to header that need to grow the header, the
   * dropdown should have a `site-header__dropdown` CSS class, and when active
   * get a `site-header__dropdown--active` CSS class added.
   */
  const siteHeaderObserver = new MutationObserver((mutationList) => {
    // Do nothing if in mobile menu.
    if (!isDesktopNav()) return;

    mutationList.forEach((mutation) => {
      if (mutation.target.classList.contains('site-header__dropdown')) {
        const height = mutation.target.offsetHeight;
        if (mutation.target.classList.contains('site-header__dropdown--active')) {
          siteHeader.setAttribute('style', `--site-header-dropdown-height: ${height}px`)
        }
        else {
          // Make sure that there are no other dropdowns open before removing
          // extra height from the header.
          if (!siteHeader.querySelector('.site-header__dropdown--active')) {
            siteHeader.setAttribute('style', `--site-header-dropdown-height: 0px`)
          }
        }
      }
    });
  });

  siteHeaderObserver.observe(siteHeader, { attributes: true, childList: false, subtree: true });

  /**
   * Enables/disables a focus trap on the mobile menu wrapper.
   *
   * @param {boolean} focusTrapToBeEnabled - True if the focus trap should be enabled,
   * otherwise false.
   */
  Drupal.dripyard.toggleFocusTrap = focusTrapToBeEnabled => {
    if (!Drupal.dripyard.isDesktopNav() && focusTrapToBeEnabled === true) {
      document.querySelectorAll(Drupal.dripyard.focusableElementsSelector).forEach(focusableElement => {
        if (!siteHeader.contains(focusableElement)) {
          focusableElement.inert = true;
          focusableElement.dataset.mobileMenuInert = true;
        }
      });
    }
    else {
      document.querySelectorAll('[data-mobile-menu-inert]').forEach(el => {
        el.inert = false;
        delete el.dataset.mobileMenuInert;
      });
    }
  }

})(Drupal);
