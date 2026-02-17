# Icon List Component

A flexible list component for displaying items with icons, supporting various sizing, icon colors, and column layouts. Perfect for feature lists, benefits, checkmarks, and structured content presentation.

## Usage

```twig
{% embed 'dripyard_base:icon-list' with {
  size: 'medium',
  icon_color: 'primary',
  column_width: 'full-width'
} only %}
  {% block content %}
    {{ include('dripyard_base:icon-list-item', {
      icon: 'check',
      text: 'All of our themes are built to WCAG 2.2 AA standards.',
      href: '/accessibility'
    }, with_context = false) }}
    {{ include('dripyard_base:icon-list-item', {
      icon: 'shield',
      text: 'Security-first development approach with regular updates.'
    }, with_context = false) }}
    {{ include('dripyard_base:icon-list-item', {
      icon: 'rocket',
      text: 'Optimized for performance and fast loading times.'
    }, with_context = false) }}
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `size` | string | Yes | Controls icon and font size: small, medium, large |
| `icon_color` | string | Yes | Icon color variant: primary, secondary, normal |
| `column_width` | string | Yes | Layout width: small, medium, large, full-width |

### Slots

| Slot | Description |
|------|-------------|
| `content` | Icon list items - typically multiple icon-list-item components |

## Size Variants

- **Small**: Compact icons and text for dense layouts
- **Medium**: Default size for standard use cases
- **Large**: Prominent icons and text for emphasis

## Icon Color Options

- **Primary**: Uses theme primary color for icons
- **Secondary**: Uses theme secondary color for icons
- **Normal**: Uses standard text color for icons

## Column Width Options

- **Small**: Narrow column layout for sidebar content
- **Medium**: Medium-width column for balanced layouts
- **Large**: Wide column for main content areas
- **Full-width**: Spans the full available width

## CSS Custom Properties

### Layout Variables
- `--icon-list-row-gap` - Spacing between list items and column gap (default: 20px)
- `--icon-list-column-width` - Width of columns in multi-column layout (default: 300px)

### Column Width Variants
- **Small**: `--icon-list-row-gap: 24px`, `--icon-list-column-width: 300px`
- **Medium**: `--icon-list-row-gap: 24px`, `--icon-list-column-width: 400px`
- **Large**: `--icon-list-row-gap: 40px`, `--icon-list-column-width: 600px`
- **Full-width**: `--icon-list-column-width: auto`

## Integration

- **Icon component**: Utilizes the theme's icon component for consistent icon rendering
- **Theme system**: Integrates with theme color and spacing variables
- **Modular design**: Works with icon-list-item components for flexible content structure
- **Container aware**: Adapts to parent container sizing and constraints
