/**
 * @file
 * Switch vertical tabs to horizontal at narrow widths to ensure
 * functionality at small viewports.
 */
((Drupal, once) => {
  let tabGroup;

  /**
   * Initialize everything.
   * @param {Element} el - the <sl-tab-group> element.
   */
  function init(el) {
    tabGroup = el;
    const mediaQuery = window.matchMedia('(width < 700px');

    if (tabGroup.matches('[placement="start"], [placement="end"]')) {
      const originalPlacement = tabGroup.getAttribute('placement');
      tabGroup.setAttribute('data-original-placement', originalPlacement);
      toggleHorizontalMode(mediaQuery.matches);

      mediaQuery.addEventListener('change', (e) => {
        toggleHorizontalMode(e.matches);
      });
    }
  }

  /**
   * Toggles between horizontal and vertical tab modes.
   *
   * @param {boolean} toHorizontal - whether to switch to horizontal (or back).
   */
  function toggleHorizontalMode(toHorizontal) {
    const tabGroups = document.querySelectorAll('[data-original-placement]');

    if (toHorizontal) {
      tabGroups.forEach(el => el.setAttribute('placement', 'top'));
    }
    else {
      tabGroups.forEach(el => {
        originalPlacement = el.getAttribute('data-original-placement');
        if (originalPlacement) {
          el.setAttribute('placement', originalPlacement);
        }
      });
    }
  }

  /**
   * Remove the custom web component element, and replace it with a <div>. This
   * removes the custom Tab Group interactions and is useful when editing tabs
   * within Canvas.
   *
   * @param {HTMLElement} tabGroup
   */
  function revertToNonWebComponentBehavior(tabGroup) {
    const div = document.createElement('div');
    div.className = tabGroup.className;
    div.innerHTML = tabGroup.innerHTML;

    // Copy all attributes except the ones that make it a webcomponent
    Array.from(tabGroup.attributes).forEach(attr => {
      if (!attr.name.startsWith('data-') || attr.name === 'data-original-placement') {
        div.setAttribute(attr.name, attr.value);
      }
    });

    tabGroup.parentNode.replaceChild(div, tabGroup);
  }

  Drupal.behaviors.tabGroup = {
    attach(context) {
      once('tabGroup', 'sl-tab-group', context).forEach((el) => {
        init(el);

        // If we're in Canvas edit mode, remove the tab functionality.
        if (Drupal.dripyard?.isCanvasEditor?.() && el.closest('.tabs').classList.contains('canvas-edit-mode')) {
          revertToNonWebComponentBehavior(el);
        };
      });
    },
  };
})(Drupal, once);
