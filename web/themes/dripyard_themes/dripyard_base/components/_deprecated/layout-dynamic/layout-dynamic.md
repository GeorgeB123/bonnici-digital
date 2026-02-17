# Dynamic Layout Component

A flexible grid layout system that enables the creation of dynamic 1, 2, 3, and 4 column layouts with configurable rows, spacing, and alignment options. Perfect for creating complex layouts that adapt to content needs.

## Usage

```twig
{% embed 'dripyard_base:layout-dynamic' with {
  section_width: 'edge-to-edge',
  content_width: 'max-width',
  column_count: 1,
  row_count: 1,
  cell_align_x: 'default',
  cell_align_y: 'default',
  margin_top: 'zero',
  margin_bottom: 'zero',
  padding_top: 'large',
  padding_bottom: 'large',
  row_gutter: 'default',
  column_gutter: 'default',
  theme: 'inherit'
} only %}
  {% block header %}
    <h2>Section Header</h2>
  {% endblock %}

  {% block cell_1 %}
    <p>Content for first cell</p>
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Default | Description |
|----------|------|----------|---------|-------------|
| `section_width` | string | **Yes** | - | Section width: `edge-to-edge` (full screen width) or `max-width` (constrained) |
| `content_width` | string | **Yes** | - | Content width: `edge-to-edge`, `max-width`, or `narrow` |
| `column_count` | number | **Yes** | - | Number of columns: `1`, `2`, `3`, or `4` |
| `row_count` | number | **Yes** | - | Number of rows: `1`, `2`, `3`, or `4` |
| `cell_align_x` | string | **Yes** | - | Cell horizontal alignment: `default`, `start`, `center`, `end` |
| `cell_align_y` | string | **Yes** | - | Cell vertical alignment: `default`, `top`, `center`, `bottom` |
| `padding_top` | string | **Yes** | - | Top padding: `zero`, `small`, `medium`, `large` |
| `padding_bottom` | string | **Yes** | - | Bottom padding: `zero`, `small`, `medium`, `large` |
| `column_gutter` | string | **Yes** | - | Column spacing: `default`, `zero`, `small`, `medium`, `large` |
| `row_gutter` | string | **Yes** | - | Row spacing: `default`, `zero`, `small`, `medium`, `large` |
| `theme` | string | No | `inherit` | Theme variant: `inherit`, `white`, `light`, `dark`, `black`, `primary` |
| `two_column_layout` | string | No | `50% / 50%` | Two column proportions (only used when `column_count` is 2): `50% / 50%`, `25% / 75%`, `33% / 67%`, `75% / 25%`, `67% / 33%` |
| `three_column_layout` | string | No | `33% / 33% / 33%` | Three column proportions (only used when `column_count` is 3): `33% / 33% / 33%`, `50% / 25% / 25%`, `25% / 50% / 25%`, `25% / 25% / 50%` |
| `margin_top` | string | **Yes** | `zero` | Override top margin: `zero`, `small`, `medium`, `large` |
| `margin_bottom` | string | **Yes** | `zero` | Override bottom margin: `zero`, `small`, `medium`, `large` |
| `additional_classes` | string | No | - | Additional CSS classes for custom styling (separated by spaces) |

### Slots

The component provides a header slot plus up to 16 content slots (cells) that are numbered sequentially. The actual number of available cells depends on your `column_count` × `row_count` configuration.

| Slot | Description |
|------|-------------|
| `header` | Optional header content displayed above the grid layout |
| `cell_1` - `cell_16` | Content blocks positioned within the grid. Cells are filled left-to-right, top-to-bottom |

## Width Control

### Section Width
- **edge-to-edge**: Layout spans full viewport width
- **max-width**: Layout constrained to theme's maximum width

### Content Width
- **edge-to-edge**: Content spans full section width
- **max-width**: Content always constrained to theme's maximum width
- **narrow**: Content uses a narrower width

## Spacing System

### Margin & Padding
Control external (margin) and internal (padding) spacing:
- **zero**: No spacing (0px)
- **small**: 40px spacing
- **medium**: 64px spacing on mobile, 80px on screens >700px wide
- **large**: 80px spacing on mobile, 120px on screens >700px wide

*Note: These pixel values may be overwritten by subthemes through CSS variable customization.*

### Gutters
Control spacing between grid cells:
- **zero**: No spacing (0px)
- **small**: 20px spacing
- **medium**: 40px spacing
- **large**: 64px spacing
- **default**: Theme's default gutter spacing

*Note: These pixel values may be overwritten by subthemes through CSS variable customization.*

## Alignment Options

### Horizontal Alignment (`cell_align_x`)
- **start**: Align content to left (or right in RTL)
- **center**: Center content horizontally
- **end**: Align content to right (or left in RTL)
- **default**: No specific alignment

### Vertical Alignment (`cell_align_y`)
- **top**: Align content to top of cell
- **center**: Center content vertically
- **bottom**: Align content to bottom of cell
- **default**: No specific alignment

## CSS Custom Properties

- `--layout-dynamic-padding-block` - Default padding block for the layout
- `--layout-dynamic-padding-inline` - Default padding inline for the layout
- `--layout-dynamic-border-radius` - Border radius for the entire layout

## Responsive Behavior

The layout uses CSS Grid for flexible, responsive behavior. The component automatically handles:
- Container-based responsive adjustments
- Grid template generation based on column/row configuration
- Proportional column sizing for 2 and 3 column layouts
