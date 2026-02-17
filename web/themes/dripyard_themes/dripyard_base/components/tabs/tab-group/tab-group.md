# Tab Group

The tab-group component is built off of shoelace web component library (see https://shoelace.style/components/tab-group). It provides highly accessible tabbed interfaces with appropriate keyboard navigation and focus management.

The component supports tabs positioned on any side of the tab panel and integrates with icons that can be displayed above or next to the tab text. At mobile widths, vertical tabs automatically switch to horizontal mode for better user experience at narrow viewports.

## Usage

```twig
{% embed 'dripyard_base:tab-group' with {
  placement: 'top',
  icon_placement: 'vertical',
  icon_size: 'small',
  centered: false,
  canvas_edit_mode: false
} only %}
  {% block tabs %}
    {% embed 'dripyard_base:tab' with {
      title: 'First Tab',
      icon: 'home'
    } only %}
      {% block tab_panel_content %}
        <p>Content for the first tab...</p>
      {% endblock %}
    {% endembed %}

    {% embed 'dripyard_base:tab' with {
      title: 'Second Tab'
    } only %}
      {% block tab_panel_content %}
        <p>Content for the second tab...</p>
      {% endblock %}
    {% endembed %}
  {% endblock %}
{% endembed %}
```

## Slots and Props

### Props
| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `canvas_edit_mode` | boolean | No | Enable to make it easier to place and edit subcomponents from within the Canvas editor |
| `placement` | string | No | Tab position: `top`, `start`, `bottom`, `end` (default: `top`) |
| `icon_placement` | string | No | Icon positioning: `vertical`, `horizontal` (default: `vertical`) |
| `icon_size` | string | No | Icon size: `small`, `large` (default: `small`) |
| `centered` | boolean | No | Centers the tab group content (default: `false`) |

### Slots
| Slot | Description |
|------|-------------|
| `tabs` | Required slot for tab content using `dripyard_base:tab` components |

## CSS Custom Properties

### Tab Styling
- `--tab-inactive-text-color` - Text color for inactive tabs (default: `var(--theme-text-color-soft)`)
- `--tab-inactive-icon-color` - Icon color for inactive tabs (default: `currentColor`)
- `--tab-active-text-color` - Text color for active tabs (default: `var(--theme-text-color-loud)`)
- `--tab-active-border-color` - Border color for active tab indicator (default: `var(--theme-border-color-alt)`)
- `--tab-active-icon-color` - Icon color for active tabs (default: `var(--theme-border-color-alt)`)
- `--tab-font-size` - Font size for tab text (default: `var(--body-s-size)`)
- `--tab-font-weight` - Font weight for tab text (default: `normal`)
- `--tab-padding-block` - Block padding for individual tabs (default: `var(--sp2)`)
- `--tab-padding-inline` - Inline padding for individual tabs (default: `var(--spacing-xs)`)
- `--tab-scroll-button-color` - Color for scroll buttons when tabs overflow (default: `var(--theme-border-color-alt)`)

### Panel Styling
- `--tab-panel-padding-block` - Block padding for tab panel content (default: `var(--spacing-s)`)
- `--tab-panel-padding-inline` - Inline padding for tab panel content (default: `var(--spacing-s)`)
- `--tab-panel-border-color` - Border color for tab panels (default: `transparent`)

### Indicator Styling
- `--tab-active-border-width` - Width of the active tab indicator (default: `5px`)
- `--tab-track-width` - Width of the tab track/rail (default: `5px`)
- `--tab-track-color` - Color of the tab track/rail (default: `color-mix(in oklch, var(--theme-border-color) 50%, transparent)`)

## Accessibility Considerations

- Built on Shoelace web components with full ARIA support
- Keyboard navigation with arrow keys, Home, End, and Tab
- Proper focus management and focus ring styling
- Screen reader announcements for active tab changes
- Semantic HTML structure with appropriate roles

## Shoelace Web Component Integration

The tab-group component uses Shoelace's `sl-tab-group` web component with custom styling:

### CSS Part Styling
The component targets specific Shoelace CSS parts:
- `::part(base)` - Main tab group container
- `::part(nav)` - Tab navigation wrapper
- `::part(tabs)` - Tab list container
- `::part(active-tab-indicator)` - Active tab visual indicator
- `::part(scroll-button)` - Navigation buttons for overflow
- `::part(scroll-button__base)` - Navigation button styling
- `::part(body)` - Tab panel area (configured as CSS Grid)

### Focus Management
- Uses `--sl-focus-ring: solid 2px var(--theme-focus-ring-color)` for consistent focus styling
- Focus ring offset is set to `-5px` for proper visual alignment

## Canvas Editor Integration

When `canvas_edit_mode` is enabled and the component is in Canvas editor context:
- Tab panels are displayed with additional padding and visibility overrides
- Tab functionality is disabled to allow easier component editing
- The component reverts to non-web component behavior for editing convenience

## Icon Configuration

### Icon Placement
- **`vertical`**: Icons appear above the tab text (default)
- **`horizontal`**: Icons appear to the left of the tab text

### Icon Size
- **`small`**: Icons are sized to `var(--sp2)` height
- **`large`**: Icons are sized to `32px` height (default)

## Responsive Behavior

The component includes automatic responsive switching for vertical tabs:
- Tabs positioned `start` or `end` automatically switch to `top` placement when viewport width is less than 700px
- Original placement is stored in `data-original-placement` attribute and restored when returning to wider viewports
- Media query uses `(width < 700px)` for the responsive breakpoint

## Library Dependencies

The component includes the following assets:
- `shoelace-tabs/wa-tab-group.css` - Shoelace component base styles
- `shoelace-tabs/wa-tab-group.bundle.js` - Shoelace web component JavaScript bundle
- `tab-group.css` - Custom styling overrides
- `tab-group.js` - Responsive behavior and Canvas editor integration
- Dependencies: `core/drupal`, `core/once`
