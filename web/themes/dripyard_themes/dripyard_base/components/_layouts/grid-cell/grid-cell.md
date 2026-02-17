# Grid Cell Component

A responsive grid cell that spans a configurable number of columns and rows within a 6 or 12 (> 600px) column CSS grid system. Provides precise layout control across different container sizes using modern CSS container queries, with built-in theme support and flexible content padding.

This component is meant to be directly within the `grid_cells` slot of the Grid Wrapper component.

## Usage

```twig
{% embed 'dripyard_base:grid-cell' with {
  columns_small: 12,
  columns_medium: 6,
  columns_large: 4,
  rows_small: 1,
  rows_medium: 1,
  rows_large: 1,
  padding: 'medium',
  horizontal_alignment: 'center',
  vertical_alignment: 'center',
  theme: 'light'
} only %}
  {% block content %}
    <h3>Cell Content</h3>
    <p>This content will span different numbers of columns based on screen size.</p>
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Default | Description |
|----------|------|----------|---------|-------------|
| `padding` | string | **Yes** | - | Cell padding: `zero`, `small`, `medium`, `large` |
| `columns_small` | integer | **Yes** | - | Columns to span on small containers (1-12). Note: Value is halved for 6-column small breakpoint |
| `columns_medium` | integer | **Yes** | - | Columns to span on medium containers > 600px (1-12) |
| `columns_large` | integer | **Yes** | - | Columns to span on large containers > 1200px (1-12) |
| `rows_small` | integer | **Yes** | - | Rows to span on small containers (1+) |
| `rows_medium` | integer | **Yes** | - | Rows to span on medium containers > 600px (1+) |
| `rows_large` | integer | **Yes** | - | Rows to span on large containers > 1200px (1+) |
| `horizontal_alignment` | string | No | - | Horizontal alignment of content: `start`, `center`, `end` |
| `vertical_alignment` | string | No | - | Vertical alignment of content: `start`, `center`, `end` |
| `theme` | string | No | `inherit` | Theme variant: `inherit`, `white`, `light`, `dark`, `black`, `primary` |
| `additional_classes` | string | No | - | Additional CSS classes for custom styling (separated by spaces) |

### Slots

| Slot | Description |
|------|-------------|
| `content` | Main content area of the grid cell |

## Responsive Column Spanning

### Column System
Grid cells span columns within a 6 or 12-column CSS grid using container queries:
- **Small containers (default)**: Uses `columns_small` value (automatically halved for 6-column layout)
- **Medium containers (> 600px)**: Falls back to `columns_medium`, then `columns_small`
- **Large containers (> 1200px)**: Falls back through `columns_large` → `columns_medium` → `columns_small`

### Responsive Design
All column and row props are required, ensuring explicit control over layout behavior at each breakpoint. The component uses container queries for responsive behavior and a cascading system where larger containers can inherit from smaller containers if desired:

```css
/* Small containers (default) */
grid-column: span var(--grid-cell-columns-small);

/* Medium containers (> 600px) */
@container (width > 600px) {
  grid-column: span var(--grid-cell-columns-medium);
}

/* Large containers (> 1200px) */
@container (width > 1200px) {
  grid-column: span var(--grid-cell-columns-large);
}
```

**Best Practice**: Define all breakpoint values explicitly for predictable responsive behavior.

## Row Spanning

Grid cells can also span multiple rows using the same responsive container query system. All row props are required:
- **`rows_small`**: Row span for small containers (required)
- **`rows_medium`**: Row span for medium containers (required)
- **`rows_large`**: Row span for large containers (required)

Row spanning is useful for creating complex layouts where content needs to occupy vertical space across multiple grid rows. Since all props are required, you have explicit control over row behavior at each container size.

## Padding Options

### Built-in Padding Classes
- **zero**: No padding (0px) - *5px minimum in Canvas editor for selection*
- **small**: Extra small padding (`var(--spacing-xs)`)
- **medium**: Small padding (`var(--spacing-s)`)
- **large**: Medium padding (`var(--spacing-m)`)

*Note: Padding values are controlled by CSS custom properties and may be customized by themes.*

### Canvas Editor Behavior
- **Zero padding**: Automatically adds 5px padding in Canvas editor for easier component selection
- **Visual outline**: Displays a dashed outline in Canvas editor to show cell boundaries

## Content Alignment

Grid cells provide flexible content alignment options using CSS Flexbox properties:

### Horizontal Alignment
Controls the horizontal positioning of content within the cell:
- **start**: Content aligns to the left (default flexbox behavior)
- **center**: Content centers horizontally within the cell
- **end**: Content aligns to the right

### Vertical Alignment
Controls the vertical positioning of content within the cell:
- **start**: Content aligns to the top (default flexbox behavior)
- **center**: Content centers vertically within the cell
- **end**: Content aligns to the bottom

Since grid cells use `flex-direction: column`, horizontal alignment uses `align-items` (cross-axis) and vertical alignment uses `justify-content` (main-axis).

## Theme Support

Grid cells support the full theme system:
- **Theme backgrounds**: Applies `var(--theme-surface)` background when theme is set
- **Theme text colors**: Applies `var(--theme-text-color-medium)` for consistent text color
- **Theme inheritance**: Inherits theme from parent components when set to `inherit`

### Theme Options
- **inherit**: No specific theme styling (inherits from parent)
- **white**: White background theme
- **light**: Light background theme
- **dark**: Dark background theme
- **black**: Black background theme
- **primary**: Primary brand color theme

## Layout Behavior

### Flexbox Container
Grid cells use flexbox internally for content layout:
- **Direction**: Column (vertical stacking)
- **Gap**: Uses `var(--gap)` for spacing between child elements
- **Flexibility**: Content can grow and shrink as needed

### Grid Integration
- **Column spanning**: Uses `grid-column: span [number]` for precise column control
- **Row spanning**: Uses `grid-row: span [number]` for vertical layout control
- **Auto-placement**: Grid items automatically flow into available spaces

## CSS Custom Properties

- `--grid-cell-columns-small/medium/large`: Column span values for responsive behavior
- `--grid-cell-rows-small/medium/large`: Row span values for responsive behavior
- `--grid-cell-border-radius`: Border radius for the cell (default: `0`)

## Best Practices

### Responsive Design
- All responsive props are required, ensuring intentional layout decisions at each container size
- Start with `columns_small` as your container-first baseline, then adapt for larger containers
- Remember that `columns_small` values are automatically halved (e.g., 6 becomes 3) for the 6-column small layout
- Consider content readability when choosing column spans (avoid very narrow columns for text)
- Use consistent values across container sizes when you want the same layout, or vary them for responsive adaptation

### Content Guidelines
- Use appropriate padding to ensure content doesn't touch cell edges
- Consider theme contrast when placing content on themed backgrounds
- Test content at different column spans to ensure readability

### Performance
- Grid cells are lightweight and can be used extensively without performance concerns
- CSS custom properties enable efficient responsive behavior without JavaScript
- Modern CSS Grid, Flexbox, and container queries provide excellent browser performance

## Related Components

- **Grid Wrapper**: Container component that establishes the 12-column grid system
- **Section**: Layout wrapper for applying themes and container constraints
