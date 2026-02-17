# Logo Item Component

A simple logo component with optional linking functionality, designed to be used within the logo-grid component.

There's  two components in this component's directory. The `logo-item` component is meant for regular Drupal, while the `logo-item-canvas` is meant for Drupal Canvas. The main difference is that the `logo-item-canvas` has a `$ref` value that points to a Drupal Canvas schema definition. This component cannot be loaded if Canvas is not present ([Drupal.org issue](https://www.drupal.org/project/canvas/issues/3552121)), as there will be a 500 error. The two components share the same Twig file and CSS file. The regular `logo-item` component is excluded from appearing in page builder user interfaces with the `noUi: false` key value within the schema.

## Usage

```twig
{{ include('dripyard_base:logo-item', {
    image: content.field_logo_image,
    href: '/node/123',
  }, with_context = false) }}
```

### Props

| Property | Type | Description |
|----------|------|-------------|
| `image` | object | Logo image data (Experience Builder or Drupal format) |
| `href` | string | URL string for making logo clickable |

## Structure

- **Container**: `.logo-item` wrapper with flexbox centering
- **Optional link**: Wraps image when `href` is provided
- **Image**: Uses the image-or-media component for consistent rendering

## CSS Custom Properties (inherited from logo-grid)

- `--logo-grid-logo-size` - Controls the logo container size. This is inherited from the `logo-grid` component settings.
- `--logo-grid-logo-background` - Background color for logo containers. This is inherited from the `logo-grid` component settings.
- `--logo-item-height` - Height of individual logo items (inherits from `--logo-grid-logo-size`)
- `--logo-item-padding-block` - Vertical padding inside logo containers
- `--logo-item-padding-inline` - Horizontal padding inside logo containers
- `--logo-item-background-border-radius` - Border radius for logo backgrounds. This is inherited from the `logo-grid` component settings.

## Integration

- **Logo grid**: Designed specifically for use within logo-grid component
- **Image component**: Uses image-or-media for universal image handling
- **Theme system**: Inherits styling from parent logo-grid component

## Accessibility Features

- **Optional links**: Only wraps in anchor tag when href is provided
- **Image alt text**: Preserves alt text from image data
- **Semantic markup**: Clean HTML structure for screen readers
