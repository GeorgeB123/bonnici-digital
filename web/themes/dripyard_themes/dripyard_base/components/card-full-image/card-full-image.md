# Card Full Image Component

A card component with a full image background and overlay text content. Features customizable overlay colors and is designed for use within layout components.

There's  two components in this component's directory. The `card-full-image` component is meant for regular Drupal, while the `card-full-image-canvas` is meant for Drupal Canvas. The main difference is that the `card-full-image-canvas` has a `$ref` value that points to a Drupal Canvas schema definition. This component cannot be loaded if Canvas is not present ([Drupal.org issue](https://www.drupal.org/project/canvas/issues/3552121)), as there will be a 500 error. The two components share the same Twig file and CSS file. The regular `card-full-image` component is excluded from appearing in page builder user interfaces with the `noUi: false` key value within the schema.

## Usage

```twig
{{ include('dripyard_base:card-full-image', {
  image: {
    src: 'images/example.jpg',
    alt: 'Card background image',
    width: 800,
    height: 1200
  },
  title: 'Card Title',
  byline: 'Learn more',
  href: '/learn-more',
  overlay_color: 'dark',
  overlay: 'full',
  layout_vertical: 'bottom',
  title_align: 'start',
  byline_align: 'start'
}, with_context = false) }}
```

### Props

| Property | Type | Options | Required | Description |
|----------|------|---------|----------|-------------|
| `title` | string | - | Yes | Card heading text |
| `image` | object | - | Yes | Background image object with src, alt, width, height |
| `href` | string | - | Yes | Link destination URL |
| `overlay_color` | string | `light`, `dark` | Yes | Overlay theme for text contrast (also controls text color) |
| `byline` | string | - | No | Subtitle text displayed below title |
| `overlay` | string | `full`, `from bottom` | No | Overlay coverage style (defaults to full) |
| `layout_vertical` | string | `center`, `bottom` | No | Vertical positioning of title within the card |
| `title_align` | string | `start`, `center` | No | Horizontal alignment of the title text |
| `byline_align` | string | `start`, `end` | No | Horizontal alignment of the byline text |

## CSS Custom Properties

- `--card-full-image-padding` - Internal padding for card content
- `--card-full-image-gap` - Gap between title and byline elements
- `--card-full-image-aspect-ratio` - Aspect ratio of the card container
- `--card-full-image-border-radius` - Border radius for card corners
- `--card-full-image-text-color` - Text color for title and byline content
- `--card-full-image-title-font-size` - Font size for the card title
- `--card-full-image-title-line-height` - Line height for the card title
- `--card-full-image-title-letter-spacing` - Letter spacing for the card title
- `--card-full-image-byline-font-size` - Font size for the card byline
- `--card-full-image-byline-line-height` - Line height for the card byline
- `--card-full-image-byline-letter-spacing` - Letter spacing for the card byline
- `--card-full-image-overlay-color` - Base color for overlay effects
- `--card-full-image-overlay-length` - Coverage percentage for gradient overlay
- `--card-full-image-focus-ring-color` - Focus indicator color for keyboard navigation

## Media Queries

The component adapts its aspect ratio based on viewport height and component width:

```css
/* Default aspect ratio */
aspect-ratio: 5 / 7;

/* Shorter viewports */
@media (height < 900px) {
  aspect-ratio: 4 / 3;
}

/* If component width is larger than 600px, component goes into landscape mode. */
@container (width > 600px) {
  aspect-ratio: 16 / 9;
}
```

## Overlay Variants

### Dark Overlay (Default)
- **Reduced image opacity**: Image displays at 30% opacity (50% on hover)
- **High contrast text**: White text over darkened background
- **Default behavior**: No additional gradient overlay

### Light Overlay
- **Full image opacity**: Image displays at 100% opacity
- **Gradient overlay**: Linear gradient from white to transparent
- **Dark text**: Uses theme text colors for contrast

## Accessibility Features

- **Semantic article**: Uses `<article>` element for proper content structure
- **Full card links**: Entire card area is clickable for easy interaction
- **Focus indicators**: Clear focus outline with proper contrast
- **Alternative text**: Requires alt text for background images
- **Text contrast**: **Important**: Always verify text contrast when positioning text over images

## Text Contrast Considerations

**Critical**: When using light overlay or custom images, always verify text contrast ratios meet accessibility requirements. The component provides overlay options but contrast depends on image content.
