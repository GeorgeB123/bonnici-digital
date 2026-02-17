/**
 * @file
 * Customization of messages.
 */

((Drupal, once) => {
  /**
   * Adds a close button to the message.
   *
   * @param {object} message
   *   The message object.
   */
  function appendCloseMessageButton(message) {
    const messageContainer = message.querySelector('[data-drupal-selector="messages-container"]');

    if (!messageContainer.querySelector('.messages__button')) {
      const closeBtnWrapper = document.createElement('div');
      closeBtnWrapper.setAttribute('class', 'messages__button');

      const closeBtn = document.createElement('button');
      closeBtn.setAttribute('type', 'button');
      closeBtn.setAttribute('class', 'messages__close');

      const closeBtnText = document.createElement('span');
      closeBtnText.setAttribute('class', 'visually-hidden');
      closeBtnText.textContent = Drupal.t('Close message');

      messageContainer.appendChild(closeBtnWrapper);
      closeBtnWrapper.appendChild(closeBtn);
      closeBtn.appendChild(closeBtnText);

      closeBtn.addEventListener('click', () => closeMessage(message));
    }
  };

  Drupal.dripyard = Drupal.dripyard || {};
  Drupal.dripyard.appendCloseMessageButton = appendCloseMessageButton;

  /**
   * Removes the message from the DOM. Before it does this, it checks if we can
   * and should animate it out. If so, we do that, otherwise, we just yank it.
   *
   * @param {Element} message - The message element.
   */
  function closeMessage(message) {
    if (matchMedia('(prefers-reduced-motion: no-preference)') && CSS.supports('interpolate-size: allow-keywords')) {
      message.addEventListener('transitionend', (e) => {
        if (e.currentTarget == message) {
          message.remove();
        }
      });
      message.classList.add('messages--👋');
    }
    else {
      message.remove();
    }
  }

  /**
   * Get messages from context.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches the close button behavior for messages.
   */
  Drupal.behaviors.messages = {
    attach(context) {
      once('messages', '[data-drupal-selector="messages"]', context).forEach(
        appendCloseMessageButton,
      );
    },
  };

  Drupal.dripyard = Drupal.dripyard || {};
  Drupal.dripyard.appendCloseMessageButton = appendCloseMessageButton;
})(Drupal, once);
