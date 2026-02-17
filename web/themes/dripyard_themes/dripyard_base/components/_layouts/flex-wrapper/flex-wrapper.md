# Flex Wrapper Component

A flexible container layout system that uses CSS flexbox to arrange content with configurable alignment, wrapping, spacing, and theme options. Perfect for creating responsive horizontal or vertical layouts with precise alignment control.

## Usage
### Basic usage
```twig
{% embed 'dripyard_base:flex-wrapper' with {
  theme: 'inherit',
  wrap: true,
  align_x: 'center',
  align_y: 'center',
  margin_top: 'medium',
  margin_bottom: 'medium',
  padding_top: 'small',
  padding_bottom: 'small',
  column_gutter: 'medium',
  row_gutter: 'small'
} only %}
  {% block content %}
    <div>First flex item</div>
    <div>Second flex item</div>
    <div>Third flex item</div>
  {% endblock %}
{% endembed %}
```
### Example embedding buttons

```twig
{% embed 'dripyard_base:flex-wrapper' with {
  button_group,
  margin_top: 'zero',
  margin_bottom: 'zero',
  padding_top: 'zero',
  padding_bottom: 'zero',
  column_gutter: 'small',
  row_gutter: 'small',
  align_x: 'start',
  align_y: 'center',
} only %}
  {% block content %}
    {% for button in button_group %}
      {{ include('dripyard_base:button', {
          href: button.href|default('/'),
          text: button.text|default(''),
          style: button.style|default('default'),
          suffix_icon: button.suffix_icon,
          size: button.size|default('medium'),
      }, with_context = false) }}
    {% endfor %}
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `theme` | string | No | Theme variant: `inherit`, `white`, `light`, `dark`, `black`, `primary` |
| `wrap` | boolean | No | Allow flex items to wrap to new lines when container is too narrow. Defaults to `true` |
| `align_x` | string | Yes | Horizontal alignment: `start`, `center`, `end`, `space-between`, `space-around` |
| `align_y` | string | Yes | Vertical alignment: `top`, `center`, `bottom`, `stretch` |
| `margin_top` | string | Yes | Top margin: `zero`, `small`, `medium`, `large` |
| `margin_bottom` | string | Yes | Bottom margin: `zero`, `small`, `medium`, `large` |
| `padding_top` | string | Yes | Top padding: `zero`, `small`, `medium`, `large` |
| `padding_bottom` | string | Yes | Bottom padding: `zero`, `small`, `medium`, `large` |
| `column_gutter` | string | Yes | Horizontal spacing between items: `zero`, `small`, `medium`, `large` |
| `row_gutter` | string | Yes | Vertical spacing between wrapped items: `zero`, `small`, `medium`, `large` |
| `additional_classes` | string | No | Additional CSS classes for custom styling |

### Slots

| Slot | Description |
|------|-------------|
| `content` | Main content area where flex items are placed |

## Flexbox Alignment

### Horizontal Alignment (`align_x`)
- **start**: Align items to the left (or right in RTL)
- **center**: Center items horizontally within container
- **end**: Align items to the right (or left in RTL)
- **space-between**: Distribute items with equal space between them
- **space-around**: Distribute items with equal space around them

### Vertical Alignment (`align_y`)
- **top**: Align items to the top of the container
- **center**: Center items vertically within container
- **bottom**: Align items to the bottom of the container
- **stretch**: Stretch items to fill container height

## Spacing System

### Margin & Padding
Control external (margin) and internal (padding) spacing:
- **zero**: No spacing (0px)
- **small**: 40px spacing
- **medium**: 64px spacing on mobile, 80px on screens >700px wide
- **large**: 80px spacing on mobile, 120px on screens >700px wide

*Note: These pixel values may be overwritten by subthemes through CSS variable customization.*

### Gutters
Control spacing between flex items:
- **zero**: No spacing (0px)
- **small**: 20px spacing
- **medium**: 40px spacing
- **large**: 64px spacing

*Note: These pixel values may be overwritten by subthemes through CSS variable customization.*

## CSS Custom Properties

- `--flex-wrapper-padding-inline` - Default horizontal padding for the layout

## Responsive Behavior

The layout uses CSS Container Queries for responsive adjustments:

### Base Flexbox Layout
- Default gap: 20px between items
- Responsive gap: 40px horizontal, 20px vertical on containers >800px wide

### Theme Containers
- Default inline padding: `--spacing-xs` (extra small)
- Wide container padding: `--spacing-m` (medium) on containers >600px wide

## Wrapping Behavior

When `wrap` is enabled:
- Items automatically wrap to new lines when container is too narrow
- Row gutter controls vertical spacing between wrapped lines
- Maintains alignment settings across wrapped rows

## Theme Integration

The component supports the standard theme system:
- **inherit**: No specific theme styling (default)
- **white**: White background with appropriate text contrast
- **light**: Light theme background
- **dark**: Dark theme background
- **black**: Black background with light text
- **primary**: Primary color theme
