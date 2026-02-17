# Video Player

An accessible video player component that handles locally hosted videos, with enhanced user experience features and accessibility considerations.

There's  two components in this component's directory. The `video-player` component is meant for regular Drupal, while the `video-player-canvas` is meant for Drupal Canvas. The main difference is that the `video-player-canvas` has `$ref` values that points to a Drupal Canvas schema definition. This component cannot be loaded if Canvas is not present ([Drupal.org issue](https://www.drupal.org/project/canvas/issues/3552121)), as there will be a 500 error. The two components share the same Twig file and CSS file. The regular `video-player` component is excluded from appearing in page builder user interfaces with the `noUi: false` key value within the schema.

## Features

The video player provides:
- Respect for `prefers-reduced-motion` preference and pauses automatically when reduced motion is enabled
- Persistent state management through browser's localStorage to remember play/pause state
- Prominent focus states for keyboard navigation
- Click/tap interaction on both the control button and video element for play/pause

## Usage from standard Drupal

Note the example below assumes

 - The entity type is `node`
 - The video field is `field_video`
 - The field for the placeholder image (poster attribute) is `field_poster_image`

```twig
{{ include('dripyard_base:video-player', {
  video: {
    src: file_url(node.field_video.entity.field_media_video_file.entity.uri.value),
  },
  type: node.field_video.entity.field_media_video_file.entity.filemime.value|default('video/mp4'),
  aria_label: 'Grand canyon',
  poster: {
    src: file_url(node.field_poster_image.entity.field_media_image.entity.uri.value),
  },
  muted: true,
  loop: false,
  autoplay: false,
  button_align_x: 'end',
  button_align_y: 'bottom',
  border_radius: 'large',
}, with_context = false) }}

```

## CSS Custom Properties

- `--video-player-border-radius`: Border radius for the video element (defaults to 0)
- `--video-player-button-offset`: Margin offset for the play/pause button (defaults to `var(--spacing-xs)`)
- `--video-player-button-surface-color`: Background color for the play/pause button (defaults to semi-transparent black)
- `--video-player-button-icon-color`: Color for the play/pause button icon (defaults to white)
- `--video-player-button-border-radius`: Border radius for the play/pause button (defaults to `var(--radius-md)`)

## Accessibility Considerations

- The play/pause button includes proper `aria-pressed` states to indicate current playback status
- Video elements include `aria-label` attributes for screen reader compatibility
- Focus states are clearly visible with custom outline styling
- Respects user's `prefers-reduced-motion` preference by automatically pausing videos
- Keyboard navigation is fully supported
- The button provides semantic meaning through ARIA attributes

## Media/Container Queries

- The video element is responsive and scales to 100% width of its container
- The play/pause button is positioned absolutely and centered within the video container
- Button opacity transitions respect user interaction states (hover, focus)

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `video` | object | Yes | - | Video file object with `src` property |
| `aria_label` | string | No | - | Accessible description of the video content |
| `poster` | object | No | - | Video placeholder image object with `src` property |
| `muted` | boolean | No | `true` | Whether the video should be muted |
| `loop` | boolean | No | `true` | Whether the video should loop |
| `autoplay` | boolean | No | `false` | Whether the video should autoplay (respects user preferences) |
| `button_align_x` | string | No | `end` | Horizontal alignment of play/pause button (`start`, `center`, `end`) |
| `button_align_y` | string | No | `bottom` | Vertical alignment of play/pause button (`top`, `center`, `bottom`) |
| `border_radius` | string | No | - | Border radius of the video element (`small`, `medium`, `large`) |
| `type` | string | No | `video/mp4` | MIME type of the video file |
