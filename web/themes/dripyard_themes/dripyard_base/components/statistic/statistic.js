/**
 * @file
 * "Count up" feature of statistics component.
 */

((Drupal, once) => {
  /**
   * Separator of numbers (e.g. the commas in 1,200,000).
   */
  const groupingSeparator = ',';

  /**
   * Returns any text that appears before the first number in a string.
   *
   * @param {string} input
   * @returns string
   */
  function getTextBeforeFirstNumber(input) {
    const match = input.match(/^[^\d]*/);
    return match ? match[0] : '';
  }

  /**
   * Returns any text that appears after the last number in a string.
   *
   * @param {string} input
   * @returns string
   */
  function getTextAfterLastNumber(input) {
    const match = input.match(/(\d+)(\D*)$/);
    return match ? match[2] : '';
  }

  /**
   * Returns the number of decimal places a string (usually a number) has.
   *
   * @param {string} input - Any string that may or may not contain decimal places
   * @returns number
   */
  function getDecimalPlaces(input) {
    const str = String(input);
    const decimalIndex = str.indexOf('.');

    if (decimalIndex === -1) {
      return 0; // No decimal point
    }

    return str.length - decimalIndex - 1;
  }

  /**
   * Strips out everything except commas, decimals, and numbers.
   *
   * @param {string} input - Any string
   * @returns string
   */
  function keepNumbersCommasDecimals(input) {
    return input.replace(/[^\d,\.]/g, '');
  }

  /**
   * Takes the text within a HTML element, separates any prefix or suffix text,
   * detects if there are commas or decimals, and then increments the number
   * when the element enters the viewport. This will maintain existing
   * prefixes and suffixes.
   *
   * @param {HTMLElement} el - HTML Element containing only text.
   */
  function incrementNumberWithinText(el) {
    const statText = el.innerText;
    const number = keepNumbersCommasDecimals(statText)
    const prefixText = getTextBeforeFirstNumber(statText);
    const suffixText = getTextAfterLastNumber(statText);
    el.innerText = number

    const numAnim = new countUp.CountUp(el, null, {
      startVal: 0,
      useGrouping: number.includes(groupingSeparator),
      decimalPlaces: getDecimalPlaces(number),
      separator: groupingSeparator,
      prefix: prefixText,
      suffix: suffixText,
      useIndianSeparators: false,
    });

    // We use Intersection Observer instead of CountUp's `enableScrollSpy`
    // because the latter uses a scroll event, which is less performant.
    const observer = new IntersectionObserver((entries) => {
      if (entries[0].isIntersecting) {
        numAnim.start();
      }
    });
    observer.observe(el);
  }

  /**
   * Looks through the element and sets up each individual stat if browser
   * setting is not set to reduce motion.
   *
   * @param {HTMLElement} el - The entire stats component's HTML element.
   */
  function init(el) {
    if (!window.matchMedia('(prefers-reduced-motion)').matches) {
      el.querySelectorAll('.stat__stat').forEach(incrementNumberWithinText);
    }
  }

  Drupal.behaviors.statCounter = {
    attach(context) {
      once('statistics', '.stat', context).forEach(init);
    },
  };
})(Drupal, once);
