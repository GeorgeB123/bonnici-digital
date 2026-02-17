/**
 * @file
 * Layout Builder UI helper.
 */
((Drupal) => {
  const contentAboveHelpMessage = Drupal.t(`Intended for "<strong>Dripyard Title CTA</strong>" components only.`);

  function processTabGroup(tabGroup) {
    const tabAddBlockButton = tabGroup.querySelector('[data-region="content"] .layout-builder__add-block');
    const helperMessage = document.createElement('div');

    // Add helper message to for tab slot.
    helperMessage.classList.add('layout-builder__helper-message');
    helperMessage.textContent = Drupal.t('Tab Item blocks only');
    tabAddBlockButton.appendChild(helperMessage);

    // Add CSS class once finished.
    tabGroup.classList.add('layout-builder-helper-processed');
  }

  function processAccordionGroup(accordionGroup) {
    const accordionGroupAddBlockButton = accordionGroup.querySelector('[data-region="content"] .layout-builder__add-block');
    const helperMessage = document.createElement('div');

    // Open all accordion items.
    accordionGroup.querySelectorAll('.accordion-item').forEach(el => el.setAttribute('open', true));

    // Add helper message to for tab slot.
    helperMessage.classList.add('layout-builder__helper-message');
    helperMessage.textContent = Drupal.t('Accordion Item blocks only');
    accordionGroupAddBlockButton.appendChild(helperMessage);

    // Add CSS class once finished.
    accordionGroup.classList.add('layout-builder-helper-processed');
  }

  function processDripyardLayout(layout) {
    const topAddBlockButton = layout.querySelector('[data-region="top"] .layout-builder__add-block');
    const topHelperMessage = document.createElement('div');
    // Add helper message for content_above slot.
    topHelperMessage.classList.add('layout-builder__helper-message');
    topHelperMessage.innerHTML = contentAboveHelpMessage;
    topAddBlockButton?.appendChild(topHelperMessage);

    // Add CSS class once finished.
    layout.classList.add('layout-builder-helper-processed');
  }

  /**
   * Check if the toolbar is within the viewport. If not, we assume Safari isn't
   * positioning properly because of a parent query container.
   *
   * @param {IntersectionObserverEntry} entries
   */
  function processLb(entries) {
    entries.forEach((entry) => {
      if (!entry.isIntersecting & !document.body.classList.contains('safari-not-doing-position-fixed-properly-because-it-sucks')) {
        document.body.classList.add('safari-not-doing-position-fixed-properly-because-it-sucks');
      }
    });
  }

  /**
   * Set up Intersection Observer on LB toolbar.
   *
   * @param {Element} toolbar - Layout Builder toolbar element.
   */
  function processLbToolbarAndMessages(toolbar) {
    const lbObserver = new IntersectionObserver(processLb, { threshold: 1 });
    lbObserver.observe(toolbar);
  }

  Drupal.behaviors.layoutBuilderHelper = {
    attach(context) {
      const tabGroups = context.querySelectorAll('.tabs:not(.layout-builder-helper-processed)');
      tabGroups.forEach((tabGroup) => {
        processTabGroup(tabGroup);
      });


      const accordionGroups = context.querySelectorAll('.accordion-group:not(.layout-builder-helper-processed)');
      accordionGroups.forEach((accordionGroup) => {
        processAccordionGroup(accordionGroup);
      });

      const dripyardLayouts = context.querySelectorAll('.layout-1-col, .layout-2-col, .layout-3-col, .layout-4-col');
      dripyardLayouts.forEach((layout) => {
        processDripyardLayout(layout);
      });


      const lbToolbar = context.querySelectorAll('.layout-builder-form .form-actions');
      lbToolbar.forEach(toolbar => processLbToolbarAndMessages(toolbar));
    },
  };
})(Drupal);
