/**
 * @file
 * Helpers to let components know if they're in the Canvas editor or preview.
 *
 * @todo
 * This will hopefully be redundant when https://www.drupal.org/i/3492358 lands.
 */

((Drupal, once) => {
  Drupal.dripyard = Drupal.dripyard || {};

  Drupal.dripyard.isCanvas = () => {
    return document.body.classList.contains('is-canvas');
  }

  Drupal.dripyard.isCanvasEditor = () => {
    return Drupal.dripyard.isCanvas() && parent.document.body.querySelectorAll('[data-canvas-preview]').length > 0;
  }

  Drupal.dripyard.isCanvasPreview = () => {
    return Drupal.dripyard.isCanvas() && !Drupal.dripyard.isCanvasEditor();
  }

  /**
   * Add CSS classes to the <body> element to inform styles if they are in editor or preview.
   */
  function init() {
    if (Drupal.dripyard.isCanvasEditor()) {
      document.body.classList.remove('is-canvas-preview');
      document.body.classList.add('is-canvas-editor');
    }

    if (Drupal.dripyard.isCanvasPreview()) {
      document.body.classList.remove('is-canvas-editor');
      document.body.classList.add('is-canvas-preview');
    }
  }

  Drupal.behaviors.canvasHelper = {
    attach(context) {
      once('canvas-helper', 'body', context).forEach(init);
    },
  };
})(Drupal, once);
