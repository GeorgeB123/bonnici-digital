/**
 * @file
 * Various JS helpers.
 */
((Drupal, once) => {
  /**
   * Sets the appropriate aspect ratio of an iframe based on its width and height.
   * @param {Element} iframe - An <iframe>.
   */
  function iframeHelper(iframe) {
    const iframeWidth = iframe.getAttribute('width');
    const iframeHeight = iframe.getAttribute('height');
    if (iframeWidth && iframeHeight) {
      iframe.style.aspectRatio = `${iframeWidth} / ${ iframeHeight }`;
    }
  }

  Drupal.behaviors.helper = {
    attach(context) {
      once('iframe-helper', 'iframe', context).forEach(iframeHelper);
    },
  };
})(Drupal, once);
