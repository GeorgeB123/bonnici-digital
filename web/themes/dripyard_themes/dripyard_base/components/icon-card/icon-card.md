# Icon Card Component

A flexible card component featuring an icon, title, body text, and clickable link with multiple layout and styling options.

## Usage

```twig
{{ include('dripyard_base:icon-card', {
  icon: 'cloud',
  title: 'Cloud Services',
  body: 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
  href: 'https://example.com',
  layout: 'portrait',
  icon_size: 'large',
  no_background: false
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `icon` | string | Yes | Icon name from FontAwesome set |
| `title` | string | Yes | Card title text |
| `href` | string | No | Link URL (uri-reference format) - makes the entire card clickable |
| `body` | string | No | Body text content (max 125 characters) |
| `no_background` | boolean | No | Remove background styling |
| `layout` | string | No | Layout orientation: portrait (default), landscape |
| `icon_size` | string | No | Icon size: small (32px), medium (48px), large (64px) |

## CSS Custom Properties

- `--icon-card-surface-color` - Background color for the card
- `--icon-card-text-color` - Color for body text
- `--icon-card-title-color` - Color for the title
- `--icon-card-link-color` - Color for link elements
- `--icon-card-icon-color` - Color for the icon
- `--icon-card-hover-box-shadow-color` - Shadow color on hover

## Layout Options

### Portrait Layout (default)
- **Icon position**: Above the text content
- **Content flow**: Vertical column layout
- **Title behavior**: Auto margin for bottom alignment

### Landscape Layout
- **Icon position**: Left side of the text content
- **Content flow**: Horizontal row layout
- **Gap**: Larger spacing (24px) between icon and content

## Icon Sizing

- **Small**: 32px icon size
- **Medium**: 48px icon size (default)
- **Large**: 64px icon size

## Visual Effects

- **Hover animation**: Box shadow appears on link hover
- **Transition**: Smooth 0.2s box shadow transition
- **Link overlay**: Entire card is clickable via positioned pseudo-element
- **Background options**: Standard background or transparent

## Accessibility Features

- **Semantic markup**: Uses `<article>` element for card structure
- **Proper heading**: Title uses h3 for semantic hierarchy
- **Link accessibility**: Entire card is clickable with proper focus states
- **Color contrast**: Uses theme color variables for accessibility compliance

## Integration

- **Icon component**: Uses the theme's icon component for FontAwesome icons
- **Theme system**: Integrates with theme color and spacing variables
- **Responsive design**: Flexible layout adapts to container constraints
- **Content limits**: Body text limited to 125 characters for optimal display
- **Rich content**: Strips HTML tags from body field except for `strong`, `p`, `br`, and `em`.
