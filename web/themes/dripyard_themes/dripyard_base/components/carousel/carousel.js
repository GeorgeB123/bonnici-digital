/**
 * @file
 * Carousel setup.
 */

((Drupal, once) => {
  /**
   * Determines how many slides can fit.
   *
   * @param {HTMLElement} el - the carousel component element.
   * @returns number
   */
  function getSlidesPerView(el) {
    const maxSlidesPerView = el.dataset.slidesPerView;
    const slideWrapper = el.querySelector('.carousel__inner');
    const offsetWidth = slideWrapper.offsetWidth;

    if (offsetWidth > 1400) return maxSlidesPerView;
    if (offsetWidth > 1200) return Math.min(maxSlidesPerView, 4);
    if (offsetWidth > 800) return Math.min(maxSlidesPerView, 3);
    if (offsetWidth > 650) return Math.min(maxSlidesPerView, 2);
    return 1.075;
  }

  /**
   * Initialize everything.
   *
   * @param {HTMLElement} el - The carousel component's element.
   */
  function init(el) {
    const swiperId = el.dataset.swiperId;
    const firstSlide = el.querySelector('.swiper-wrapper > *:first-child');
    let spaceBetweenSlides = 20;

    if (firstSlide) {
      const gap = parseInt(window.getComputedStyle(firstSlide).getPropertyValue('gap'), 10);
      spaceBetweenSlides = !isNaN(gap) ? gap : 10;
    }

    const transitionSpeed = window.matchMedia('(prefers-reduced-motion)').matches ? 1 : 300;

    const autoplay = el.dataset.autoplay === 'true' ? {
      delay: 5000,
      disableOnInteraction: true,
      pauseOnMouseEnter: true,
    } : false;

    const swiper = new Swiper(el.querySelector('.swiper'), {
      direction: 'horizontal',
      speed: transitionSpeed,
      spaceBetween: spaceBetweenSlides,
      initialSlide: 0,
      loop: false,
      autoplay: autoplay,
      grid: {
        rows: el.dataset.rows || 1,
        fill: 'row'
      },
      pagination: {
        el: `.swiper-pagination--${swiperId}`,
        clickable: true,
        renderBullet: function (index, className) {
          return `<button type="button" class="${className}">
            <span class="visually-hidden">${Drupal.t('Slide @count', { '@count': index + 1 })}</span>
          </button>`;
        }
      },
      slidesPerView: getSlidesPerView(el),
      navigation: {
        nextEl: `.swiper-button-next--${swiperId}`,
        prevEl: `.swiper-button-prev--${swiperId}`,
      },
      scrollbar: false,
      a11y: {
        slideRole: 'group',
        scrollOnFocus: true,
        slideLabelMessage: Drupal.t('@index of @slidesLength', { '@index': '{{index}}', '@slidesLength': '{{slidesLength}}' }),
      },
      on: {
        // For each slide, we need to surround it with a
        // `<div class="swiper-slide">` element.
        beforeInit: (swiper) => {
          const slideWrapper = swiper.el.querySelector('.swiper-wrapper');
          const slides = swiper.el.querySelectorAll('.swiper-wrapper > *');
          slides.forEach(slide => {
            const newDiv = document.createElement('div');
            newDiv.classList.add('swiper-slide');
            slideWrapper.append(newDiv);
            newDiv.append(slide);
          });
        },
        afterInit: (swiper) => {
          swiper.el.querySelectorAll('[aria-live]').forEach(el => {
            el.removeAttribute('aria-live');
          });
          swiper.el.querySelectorAll('.swiper-slide').forEach(el => {
            el.setAttribute('aria-roledescription', Drupal.t('Slide'));
          });
          swiper.navigation?.nextEl?.removeAttribute?.('aria-label');
          swiper.navigation?.prevEl?.removeAttribute?.('aria-label');

          // Setup autoplay toggle if autoplay is enabled
          if (autoplay) {
            const toggleButton = el.querySelector(`.carousel__autoplay-toggle--${swiperId}`);

            if (toggleButton) {
              toggleButton.addEventListener('click', () => {
                const isPaused = toggleButton.getAttribute('aria-pressed') === 'true';

                if (!isPaused) {
                  swiper.autoplay.stop();
                } else {
                  swiper.autoplay.start();
                }

                toggleButton.setAttribute('aria-pressed', !isPaused);
              });
            }

            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
              swiper.autoplay.stop();
              toggleButton.setAttribute('aria-pressed', 'true');
            }
          }

          // If both autoplay and pager are enabled, move the pause button there.
          if (autoplay && el.dataset.pagerEnabled === 'true') {
            const toggleButton = el.querySelector(`.carousel__autoplay-toggle--${swiperId}`);
            const pagerContainer = el.querySelector('.swiper-pagination');
            pagerContainer.prepend(toggleButton);
          }
        },
        resize: () => {
          const newSlidesPerView = getSlidesPerView(el);
          if (swiper.params.slidesPerView !== newSlidesPerView) {
            swiper.params.slidesPerView = newSlidesPerView;
            swiper.update();
          }
        },
      }
    });
  }

  Drupal.behaviors.carousel = {
    attach(context) {
      once('carousel', '.carousel:not(.layout-builder *)', context).forEach((el) => {
        if (Drupal.dripyard?.isCanvasEditor?.() && el.classList.contains('canvas-edit-mode')) return;
        init(el);
      });
    },
  };
})(Drupal, once);
