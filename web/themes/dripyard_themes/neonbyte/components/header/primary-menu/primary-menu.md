# Primary Menu Component

A complex navigation component supporting multi-level menus with responsive behavior, menu cards, and comprehensive accessibility features. Adapts between horizontal desktop and vertical mobile layouts.

## Usage

```twig
{{ include('neonbyte:primary-menu', { items }, with_context = false) }}
```

### Props

| Property | Type | Description |
|----------|------|-------------|
| `items` | array | Menu tree structure from Drupal |

## CSS Files

The component uses four CSS files for complete responsive coverage:

- **`primary-menu-wide.css`** - Desktop layout and positioning (≥1000px)
- **`primary-menu-narrow.css`** - Mobile layout and positioning (<1000px)
- **`primary-menu-wide.theme.css`** - Desktop visual styling and theme variables
- **`primary-menu-narrow.theme.css`** - Mobile visual styling and theme variables

## CSS Custom Properties

### Desktop Variables (wide.theme.css)

- `--top-level-link-border-radius` - Border radius for top-level links
- `--top-level-link-color` - Color for top-level menu links
- `--top-level-link-color-hover` - Hover color for top-level links
- `--top-level-link-font-size` - Font size for top-level links (responsive)
- `--top-level-link-font-weight` - Font weight for top-level links
- `--top-level-link-background` - Background color for top-level links
- `--top-level-link-background-hover` - Hover background for top-level links
- `--dropdown-background` - Background color for dropdown menus
- `--dropdown-border-radius` - Border radius for dropdown containers
- `--dropdown-border-width` - Border width for dropdown containers
- `--dropdown-border-color` - Border color for dropdown containers
- `--dropdown-padding` - Internal padding for dropdown content
- `--dropdown-drop-shadow` - Drop shadow for dropdown containers
- `--dropdown-link-color` - Color for dropdown menu links
- `--dropdown-link-color-hover` - Hover color for dropdown links
- `--dropdown-link-background-hover` - Hover background for dropdown links
- `--dropdown-link-border-radius` - Border radius for dropdown links
- `--dropdown-link-padding` - Padding for dropdown links
- `--dropdown-link-heading-font-size` - Font size for dropdown headings
- `--dropdown-link-font-size` - Font size for dropdown links

### Mobile Variables (narrow.theme.css)

Similar variable structure adapted for mobile breakpoints with different default values for spacing, typography, and borders.

## Responsive Behavior

The menu switches between desktop and mobile modes at **1000px** breakpoint:

### Desktop Mode (≥1000px)
- **Horizontal layout**: Top-level items displayed in a row
- **Hover and click**: Supports both interaction methods
- **Multi-level dropdowns**: Up to three levels with column layouts
- **Button integration**: Automatic toggle buttons for link-based parents
- **Menu cards**: Support for image-based promotional content

### Mobile Mode (<1000px)
- **Vertical layout**: All items stack vertically
- **Touch-friendly**: Click/tap interaction only
- **Scrollable content**: No practical item limits
- **Disclosure pattern**: Submenus expand within the flow

## Menu Structure Support

- **Link items**: Standard navigation links
- **Button items**: Created with `<button>` route for dropdown toggles
- **Nolink items**: Section headings without navigation
- **Three levels**: Top-level, secondary, and tertiary navigation
- **Menu cards**: Block-based promotional content in dropdowns

## Accessibility Features

- **Keyboard navigation**: Full keyboard support with proper focus management
- **Screen readers**: ARIA attributes for menu structure and states
- **Focus trap**: Mobile menu prevents background interaction
- **Focus indicators**: Strong focus states for all interactive elements
- **Toggle semantics**: Proper button roles and expanded states

## No JavaScript behavior

If JavaScript is not available (slow connection, something breaks, etc) we use `@media (scripting: none)` to make the primary dropdowns usable (using CSS `:hover` states, and defaulting to an open state at mobile widths).

## Integration

- **Block placement**: Must be placed in `header_second` region
- **Menu cards**: Custom blocks can be embedded in dropdowns
- **Recipe system**: Can be installed via Drupal recipes
- **Breakpoint coordination**: Shares 1000px breakpoint with header system

## Capacity Considerations

Desktop layout capacity depends on:
- Logo width and menu label length
- Presence of search, language switcher, and CTA elements
- Available horizontal space before mobile fallback
