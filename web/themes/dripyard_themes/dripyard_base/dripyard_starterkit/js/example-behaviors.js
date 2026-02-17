/**
 * @file
 * Example file with Drupal behaviors.
 *
 * @see https://www.drupal.org/docs/drupal-apis/javascript-api/javascript-api-overview
 * @see https://www.lullabot.com/articles/understanding-javascript-behaviors-in-drupal
 *
 * This file is not being invoked.
 */
((Drupal, once) => {
  /**
   * Example initialization.
   * @param {Element} el - The element that the behavior passing.
   */
  function init(el) {
    console.log(Drupal.t('This behavior is being applied to'), el);
  }

  // ⚠️ Be sure to change the "exampleBehavior" object below for every behavior.
  Drupal.behaviors.exampleBehavior = {
    attach(context) {
      once('example-behavior', '.my-selector', context).forEach(init);
    },
  };
})(Drupal, once);