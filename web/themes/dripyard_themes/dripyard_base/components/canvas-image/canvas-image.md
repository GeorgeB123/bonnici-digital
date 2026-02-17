# Canvas Image Component

A Canvas-specific image component that provides a styled wrapper around the image-or-media component with border radius options and consistent Canvas integration.

## Usage

### Basic image with lazy loading (recommended)

```twig
{{ include('dripyard_base:canvas-image', {
  image: {
    src: 'images/example.jpg',
    alt: 'Example image',
    width: 800,
    height: 600
  },
  loading: 'lazy'
}, with_context = false) }}
```

### Above-the-fold image with eager loading

```twig
{{ include('dripyard_base:canvas-image', {
  image: {
    src: 'images/hero-image.jpg',
    alt: 'Hero image',
    width: 1200,
    height: 800
  },
  loading: 'eager',
  border_radius: 'medium'
}, with_context = false) }}
```

### Custom width with border radius

```twig
{{ include('dripyard_base:canvas-image', {
  image: {
    src: 'images/profile.jpg',
    alt: 'Profile photo',
    width: 2000,
    height: 1500
  },
  width: 400,
  border_radius: 'large',
  alt: 'Custom alt text override'
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `image` | object | Yes | Canvas image object with src, alt, width, height properties |
| `image_link` | string | No | Hyperlink for the image |
| `border_radius` | string | No | Border radius size: `small`, `medium`, `large` |
| `width` | number | No | Custom image width (triggers aspect ratio calculation) |
| `aspect_ratio` | string | No | Aspect ratio override: `square`, `landscape`, `portrait`, `wide`, `tall` |
| `alt` | string/null | No | Override alt text from image data |
| `loading` | string | No | Loading behavior: `eager`, `lazy` (default: `lazy`) |

## Border Radius Options

The component provides three border radius variants:

- **small**: Uses `var(--radius-sm)` design token
- **medium**: Uses `var(--radius-md)` design token
- **large**: Uses `var(--radius-lg)` design token

## Image Data Structure

### Canvas Image Object
The `image` prop expects a Canvas image object with:
```javascript
{
  src: 'path/to/image.jpg',    // Image source URL
  alt: 'Descriptive text',     // Alternative text
  width: 1200,                 // Original image width
  height: 800                  // Original image height
}
```

## Rendering Architecture

The canvas-image component acts as a styled wrapper that:

1. **Creates wrapper element**: Applies Canvas-specific CSS classes and border radius styling
2. **Delegates to image-or-media**: Passes all image props to the universal image component
3. **Maintains Canvas context**: Ensures proper Canvas image template usage

## Aspect Ratio Options

The component provides five aspect ratio variants:

- **square**: 1:1 aspect ratio for square images
- **landscape**: 4:3 aspect ratio for traditional landscape orientation
- **portrait**: 3:4 aspect ratio for traditional portrait orientation
- **wide**: 16:9 aspect ratio for widescreen format
- **tall**: 9:16 aspect ratio for vertical/mobile-first format

## CSS Custom Properties

The component uses CSS custom properties for flexible styling:

- `--canvas-image-border-radius`: Controls the border radius (default: `0`)
- `--canvas-image-aspect-ratio`: Controls the aspect ratio (default: `auto`)

## Styling Architecture

### Display Behavior
- **Display contents**: The wrapper uses `display: contents` to avoid affecting layout
- **Direct image styling**: Styles are applied directly to the nested `<img>` element
- **Border radius inheritance**: Child image inherits border radius from wrapper

## Performance Features

- **Lazy loading default**: Optimizes page load performance by default
- **Eager loading option**: Available for critical above-the-fold images
- **Aspect ratio preservation**: Inherits aspect ratio calculation from image-or-media component
- **Canvas optimization**: Leverages Canvas's image delivery optimizations

## Integration

- **Canvas ecosystem**: Specifically designed for Canvas (Experience Builder) workflows
- **Image-or-media delegation**: Reuses universal image handling logic
- **Design system integration**: Uses design system border radius tokens
- **Component library**: Available in Canvas component library

## Accessibility Features

- **Alt text support**: Preserves or allows override of alternative text
- **Semantic markup**: Generates proper `<img>` elements with required attributes
- **Focus indicators**: Inherits focus styling from base image component
- **Screen reader compatibility**: Maintains accessibility attributes

## Best Practices

- **Loading strategy**: Use `lazy` loading for below-the-fold images, `eager` for critical images
- **Border radius**: Choose appropriate radius size for design consistency
- **Alt text**: Always provide descriptive alternative text for accessibility
- **Image optimization**: Ensure source images are properly optimized for web delivery

## Related Components

- **image-or-media**: Universal image component used internally
- **Canvas image component**: Integrates with Canvas's image delivery system
