# Video YouTube

A high-performance YouTube video embed component that provides a significantly faster alternative to standard YouTube embeds while maintaining user experience.

This component uses the [lite-youtube-embed](https://github.com/paulirish/lite-youtube-embed) library by Paul Irish, which renders YouTube videos approximately 224x faster than standard embeds by deferring the full video loading until user interaction.

## Features

- **Performance optimized**: 224x faster loading than standard YouTube embeds
- **Privacy-friendly**: Uses youtube-nocookie.com domain
- **Accessibility support**: Includes proper ARIA labels and keyboard navigation
- **Progressive enhancement**: Works without JavaScript (noscript fallback)
- **Automatic thumbnails**: Uses YouTube's high-quality thumbnail images
- **Flexible URL support**: Accepts various YouTube URL formats
- **Customizable border radius**: Optional rounded corners

## Usage

```twig
{{ include('dripyard_base:video-youtube', {
  url: 'https://www.youtube.com/watch?v=nGWdpVd8Bz8',
  title: 'Sample Video Title',
  border_radius: 'medium'
}, with_context = false) }}
```

## Props

| Property | Type | Required | Options | Description |
|----------|------|----------|---------|-------------|
| `url` | string | Yes | - | YouTube video URL in any supported format |
| `title` | string | No | - | Video title for accessibility (used in play button label) |
| `border_radius` | string | No | `small`, `medium`, `large` | Rounded corners for the video embed |

## Supported URL Formats

The component automatically extracts the video ID from various YouTube URL formats:

- `https://www.youtube.com/watch?v=VIDEO_ID`
- `https://youtu.be/VIDEO_ID`
- `https://www.youtube.com/embed/VIDEO_ID`
- `https://www.youtube.com/v/VIDEO_ID`

## CSS Custom Properties

- `--video-youtube-border-radius`: Controls the border radius of the video embed (defaults to 0)

## Performance Benefits

- **Deferred loading**: The actual YouTube iframe is only loaded when the user clicks play
- **Lightweight**: Initial load only includes a thumbnail image and minimal HTML
- **Fast rendering**: No external JavaScript execution until user interaction
- **Reduced bandwidth**: Saves data until the video is actually played

## Accessibility Features

- **Screen reader support**: Proper `playlabel` attribute provides context for assistive technologies
- **Keyboard navigation**: Full keyboard accessibility through the lite-youtube-embed library
- **Focus management**: Clear focus indicators for interactive elements
- **Semantic markup**: Uses proper button elements for play controls
