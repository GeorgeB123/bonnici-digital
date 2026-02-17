((Drupal) => {
  function init(el) {
    const video = el.querySelector('video');
    const pauseButton = el.querySelector('.video-player__play-pause');

    /**
     * Pause by default if reduced motion is enabled (this can be overridden
     * by localStorage).
     */
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) {
      video.pause();
    }

    /**
     * Pause video if localstorage indicates that its last state was paused.
     */
    if (localStorage.getItem('videoAutoPlay') === 'false') {
      video.pause();
    }
    else if (video.getAttribute('autoplay') && localStorage.getItem('videoAutoPlay') === 'true') {
      video.play();
    }

    /**
     * Keep video button state in sync.
     */
    video.addEventListener('play', () => {
      pauseButton.setAttribute('aria-pressed', false);
    });

    video.addEventListener('pause', () => {
      pauseButton.setAttribute('aria-pressed', true);
    });

    /**
     * Clicking on video should also play/pause.
     */
    video.addEventListener('click', () => pauseButton.click());

    /**
     * Ensure that state of button matches playback state.
     */
    pauseButton.setAttribute('aria-pressed', video.paused);

    /**
     * Event listener for button to play/pause video.
     */
    pauseButton.addEventListener('click', () => {
      if (video.paused) {
        video.play();
      }
      else {
        video.pause();
      }
      localStorage.setItem('videoAutoPlay', !video.paused);
    });
  }

  Drupal.behaviors.videoPlayer = {
    attach(context) {
      once('video', '.video-player', context).forEach(init);
    },
  };
})(Drupal);
