# Icon Component

A flexible component that extends Drupal core's Icon API for rendering icons with support for hyperlinks, color variants, and accessibility features. This component is designed to be overridden by child themes that may use different icon libraries.

## Usage

### Basic Icon
```twig
{{ include('dripyard_base:icon', {
  icon: 'home',
  size: 24
}, with_context = false) }}
```

### Icon with Color
```twig
{{ include('dripyard_base:icon', {
  icon: 'star',
  size: 32,
  color: 'primary'
}, with_context = false) }}
```

### Icon as Hyperlink
```twig
{{ include('dripyard_base:icon', {
  icon: 'facebook',
  size: 16,
  link_href: 'https://facebook.com',
  link_text: 'Facebook',
  open_new_window: true
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `icon` | string | Yes | Icon name from FontAwesome set |
| `size` | integer | No | Icon size in pixels (example: 32) |
| `color` | string | No | Color variant: `soft`, `medium`, `loud`, or `primary` |
| `link_href` | string | No | URL to link to (requires `link_text` to render) |
| `link_text` | string | No | Accessible link text (required for hyperlinks to render) |
| `open_new_window` | boolean | No | Whether to open link in new window/tab |

## Integration

- **Drupal Icon API**: Built on Drupal core's Icon API
- **UI Icons Support**: Automatically detects and renders UI Icons field types
- **SVG Detection**: Handles both string icon names and rendered SVG content
- **Child Theme Override**: Not exposed to Canvas - intended for child theme customization
- **Library Flexibility**: Child themes can override to use different icon libraries

## Accessibility Features

- **Required Link Text**: Hyperlinks require accessible text to render
- **Screen Reader Support**: Link text is visually hidden but available to screen readers
- **Icon Semantics**: Uses Drupal's Icon API semantic structure
- **Size Control**: Configurable size for appropriate scaling

## Forced Colors Support

The component includes comprehensive forced colors mode support for high contrast accessibility:

- **Default Context**: Icons use `canvasText` for fill and stroke
- **Link Context**: Icons nested in links use `linkText`
- **Button Context**: Icons nested in buttons use `buttonText`

This ensures proper contrast and visibility across different ancestor elements in high contrast environments.

## Recommendations

For enhanced icon management, install the [UI Icons](https://www.drupal.org/project/ui_icons) contrib module which provides an icon picker interface for easier icon selection.
