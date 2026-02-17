/*
 * @file
 * Adds `theme--white` CSS class to all jQueryUI dialog elements that open
 * on the front-end (like from Layout Builder).
 */
(function ($, Drupal) {
  Drupal.behaviors.addDialogTheme = {
    attach(context) {
      once('dialogHelper', 'body', context).forEach(() => {
        $(document).on('dialogopen', function (e) {
          const $dialog = $(e.target).closest('.ui-dialog:not(.ui-dialog-off-canvas)');
          if ($dialog.length) {
            $dialog.addClass('theme--white');
          }
        });
      });
    }
  };
})(jQuery, Drupal);
