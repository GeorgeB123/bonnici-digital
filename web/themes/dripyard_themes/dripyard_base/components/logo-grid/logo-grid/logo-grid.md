# Logo Grid Component

A flexible grid component for displaying a collection of company or partner logos with optional links and customizable layout options.

## Usage

```twig
{% embed 'dripyard_base:logo-grid' with {
  layout: 'center',
  logo_size: 'medium',
  logo_background: 'white',
  logo_border_radius: 'large',
} only %}
  {% block logo_grid_content %}
    {# Logo content #}
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `layout` | string | Yes | Logo alignment: start (default), center, end |
| `logo_size` | string | Yes | Logo size: small, medium (default), large |
| `logo_background` | string | Yes | Logo background color: auto (default), transparent, white, black, primary |
| `logo_border_radius` | string | No | Logo border radius: small, medium, large, extra large (default) |

### Slots

| Slot | Description |
|------|-------------|
| `logo_grid_content` | The logo items to render in the grid |

## CSS Custom Properties

- `--logo-grid-text-color-light` - Light text color for secondary content
- `--logo-grid-text-color` - Primary text color
- `--logo-grid-logo-size` - Size of individual logo containers (110px default)
- `--logo-grid-logo-background` - Background color for individual logo items
- `--logo-grid-logo-radius` - Border radius for individual logo items (0px default)
- `--logo-grid-gap` - Gap between logo items (20px default)

## Logo Sizing

Logo size is controlled via CSS classes:

- **Small**: 60px container width
- **Medium**: 110px container width (default)
- **Large**: 140px container width

## Layout Options

- **Start**: Left-aligned logos (default)
- **Center**: Center-aligned logos
- **End**: Right-aligned logos

## Logo Background Options

Logo background can be controlled via the `logo_background` prop:

- **Auto**: Uses theme's alternate surface color (default)
- **Transparent**: No background color
- **White**: White background
- **Black**: Black background
- **Primary**: Primary theme color background

## Logo Border Radius Options

Logo border radius can be controlled via the `logo_border_radius` prop:

- **Small**: Small border radius (var(--radius-sm))
- **Medium**: Medium border radius (var(--radius-md))
- **Large**: Large border radius (var(--radius-lg))
- **Extra Large**: Extra large border radius (200px, pill-shaped - default)

## Visual Design

- **Container**: Uses theme's container system for width constraints
- **Background**: Configurable backgrounds for each logo based on `logo_background` prop
- **Border radius**: Configurable border radius based on `logo_border_radius` prop
- **Spacing**: Configurable gap between logo items via `--logo-grid-gap`
- **Responsive**: Flexible wrapping grid layout

## Integration

- **Logo items**: Designed to work with the logo-item component
- **Content above**: Integrates with title-cta component for headings
- **Theme system**: Supports all theme color variations
