# Image or Media Component

A universal image handling component that bridges Canvas (Experience Builder) generated images and traditional Drupal image fields, providing consistent image rendering across different contexts.

## Usage

### For "above the fold" content, use `loading: 'eager'` and `fetchpriority: 'high'`

```twig
{{ include('dripyard_base:image-or-media', {
  image: image_data,
  loading: 'eager',
  fetchpriority: 'high',
  class: 'custom-image-class'
}, with_context = false) }}
```

### For "below the fold" content, use `loading: 'lazy'` (default)

```twig
{{ include('dripyard_base:image-or-media', {
  image: image_data,
  loading: 'lazy',
  class: 'custom-image-class'
}, with_context = false) }}
```

### With custom width and alt text override

```twig
{{ include('dripyard_base:image-or-media', {
  image: image_data,
  width: 800,
  alt: 'Custom alt text',
  srcset: 'image-400.jpg 400w, image-800.jpg 800w',
  sizes: '(max-width: 600px) 100vw, 50vw'
}, with_context = false) }}
```

### With standard Drupal image field (from view mode)

```twig
{{ include('dripyard_base:image-or-media', {
  image: content.field_image
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `image` | object | Yes | Image data object or Drupal render array |
| `width` | number | No | Custom image width (triggers aspect ratio calculation) |
| `alt` | string/null | No | Override alt text from image data |
| `class` | string | No | Additional CSS classes for the image |
| `loading` | string | No | Loading behavior: `eager`, `lazy` (default: `lazy`) |
| `fetchpriority` | string | No | Fetch priority: `auto`, `high`, `low` (default: `auto`) |
| `srcset` | string | No | Responsive image sources for different screen sizes |
| `sizes` | string | No | Size hints for responsive images (default: `auto 100vw`) |
| `image_attributes` | Attribute | No | Additional HTML attributes for the image element |

## Data Structure Support

### Canvas (Experience Builder) Images
Handles structured image objects with properties:
- `src` - Image source URL
- `alt` - Alternative text
- `width` - Original image width
- `height` - Original image height

### Traditional Drupal Images
Processes Drupal field render arrays:
- **Field theme**: Uses `field--bare.html.twig` template suggestion to strip wrapper markup
- **Direct output**: Renders image content directly when no field theme present

## Rendering Logic

The component automatically detects the input type:

1. **Canvas images** (`image.src` exists):
   - Uses Canvas `image` template include
   - Calculates aspect ratio when custom width is provided
   - Preserves original aspect ratio to prevent layout shifts
   - Merges all props into Canvas image template

2. **Drupal field** (`image['#theme']` exists):
   - Applies 'bare' template suggestion to remove field wrapper markup

3. **Direct content**:
   - Outputs content as-is for other image types

## Aspect Ratio Calculation

When a custom `width` is provided for Canvas images, the component automatically calculates the proportional height to maintain the original aspect ratio:

```twig
{% set aspect_ratio = image.width / image.height %}
{% set height = (width / aspect_ratio)|round %}
```

This prevents layout shifts by ensuring browsers can reserve the correct space before the image loads.

## Performance Features

- **Lazy loading**: Default loading behavior for optimal performance
- **Fetch priority**: Configurable priority for critical above-the-fold images
- **Responsive images**: Support for `srcset` and `sizes` attributes
- **Layout shift prevention**: Automatic aspect ratio preservation with custom widths
- **Canvas integration**: Leverages Canvas's optimized image delivery when available

## Integration

- **Component library**: Widely used across other theme components
- **No styling**: Pure markup component, styling handled by parent components
- **Universal compatibility**: Works seamlessly with Canvas and traditional Drupal workflows
- **Template bridge**: Provides consistent API regardless of image source type

## Accessibility Features

- **Alt text support**: Preserves alternative text from source data or allows override
- **Semantic markup**: Generates proper `<img>` elements with all required attributes
- **Attribute preservation**: Maintains accessibility attributes from source data
- **Screen reader support**: Proper image labeling and description support
