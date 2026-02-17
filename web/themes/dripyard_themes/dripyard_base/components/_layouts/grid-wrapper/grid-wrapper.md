# Grid Wrapper Component

A 6 (container width less than 600px) or 12 column CSS grid layout generator that provides a foundation for flexible grid systems. Works in combination with Grid Cell components to create responsive layouts with configurable gutters and visual grid debugging.

## Usage

```twig
{% embed 'dripyard_base:grid-wrapper' with {
  column_gutter: 'medium',
  row_gutter: 'medium',
  canvas_edit_mode: false,
  additional_classes: 'custom-grid'
} only %}
  {% block grid_cells %}
    {% include 'dripyard_base:grid-cell' with {
      columns_small: 12,
      columns_medium: 6,
      columns_large: 4,
      padding: 'medium'
    } %}
    {% include 'dripyard_base:grid-cell' with {
      columns_small: 12,
      columns_medium: 6,
      columns_large: 8,
      padding: 'medium'
    } %}
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Default | Description |
|----------|------|----------|---------|-------------|
| `column_gutter` | string | **Yes** | - | Column spacing: `zero`, `small`, `medium`, `large` |
| `row_gutter` | string | **Yes** | - | Row spacing: `zero`, `small`, `medium`, `large` |
| `canvas_edit_mode` | boolean | No | `true` | Enables visual grid debugging mode |
| `additional_classes` | string | No | - | Additional CSS classes for custom styling (separated by spaces) |

### Slots

| Slot | Description |
|------|-------------|
| `grid_cells` | Container for Grid Cell components that will be positioned within the 12-column grid |

## Grid System

### 6-Column below 600px
The Grid Wrapper creates a standard 6-column CSS grid using `repeat(6, minmax(0, 1fr))` and establishes a containment context for container queries. Grid Cell components placed within can span any number of these columns across different screen sizes using responsive container queries.

### 12-Column above 600px
The Grid Wrapper creates a standard 12-column CSS grid using `repeat(12, minmax(0, 1fr))`.

### Gutter System
Control spacing between grid items with consistent gutter options:
- **zero**: No spacing (0px)
- **small**: Extra small spacing (`var(--spacing-xs)`)
- **medium**: Medium spacing (`var(--spacing-m)`)
- **large**: Extra large spacing (`var(--spacing-xl)`)

*Note: Gutter values are controlled by CSS custom properties and may be customized by themes.*

## Visual Grid Debugging

### Canvas Edit Mode
When `canvas_edit_mode` is enabled and the component is within a Canvas editor context (`.is-canvas-editor .canvas-edit-mode`), a visual grid overlay appears showing:
- **Column areas**: Light visualization of content areas
- **Gutter areas**: Darker visualization of spacing between columns
- **12-column structure**: Clear column boundaries for alignment reference

### Grid Visualization Features
- **Dynamic gutter visualization**: Grid overlay adapts to show actual gutter spacing
- **Color mixing**: Uses modern `color-mix()` in OKLCH color space for precise color blending
- **Non-interactive overlay**: Grid visualization doesn't interfere with content interaction
- **Responsive awareness**: Visualization accurately represents the grid at any container size using modern container queries

## CSS Custom Properties

- `--grid-visualization-color`: Color used for grid debugging (default: `magenta`)
- `--grid-visualization-column-opacity`: Opacity for column areas (default: `10%`)
- `--grid-visualization-gutter-opacity`: Opacity for gutter areas (default: `0%`)

## Best Practices

### Usage with Grid Cells
- Always use Grid Cell components within the `grid_cells` slot
- Configure responsive column spans on Grid Cell components rather than the wrapper
- Use consistent gutter settings across related grid layouts for visual harmony

## Related Components

- **Grid Cell**: Individual grid items that span columns and rows within the grid wrapper
- **Section**: Layout wrapper component for applying themes and container constraints
