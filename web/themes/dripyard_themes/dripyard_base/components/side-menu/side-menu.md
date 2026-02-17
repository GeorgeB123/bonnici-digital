# Side Menu Component

A vertically stacked navigation menu component with collapsible submenus and active trail highlighting. Default implementation for menus outside header and footer regions.

## Usage

```twig
{{ include('dripyard_base:side-menu', { items, attributes }, with_context = false) }}
```

### Props

| Property | Type | Description |
|----------|------|-------------|
| `items` | array | Menu tree structure from Drupal |
| `attributes` | object | HTML attributes for the menu wrapper |

## CSS Custom Properties

- `--side-menu-text-size` - Font size for menu links
- `--side-menu-link-color` - Color for menu links
- `--side-menu-link-background-hover` - Background color on link hover
- `--side-menu-link-vertical-spacing` - Vertical padding for links
- `--side-menu-link-horizontal-spacing` - Horizontal padding for links
- `--side-menu-active-trail-background` - Background for active trail items
- `--side-menu-active-link-background` - Background for current page link
- `--side-menu-active-link-color` - Text color for current page link
- `--side-menu-submenu-indentation` - Left indentation for submenus
- `--side-menu-border-radius` - Border radius for menu elements

## Menu Structure

### Link Types
- **Standard links**: Regular navigation links
- **Button links**: Created with `<button>` route for dropdown toggles

### Hierarchy Levels
- **Level 1**: Top-level menu items with bold font weight
- **Level 2**: First submenu level with standard indentation
- **Level 3**: Nested submenus with additional background color

## Interactive Features

### JavaScript Behavior
- **Toggle controls**: Click to expand/collapse submenus
- **ARIA states**: Proper `aria-expanded` attribute management
- **Auto-expansion**: Current page menu items open by default
- **Progressive enhancement**: Graceful degradation without JavaScript

### Visual Indicators
- **Chevron icons**: Rotate to indicate expanded/collapsed state
- **Active states**: Visual highlighting for current page and trail
- **Hover effects**: Background color changes on link hover

## Responsive Design

- **Smooth transitions**: 0.2s linear transitions for height and visibility for browsers that support `interpolate-size`
- **Reduced motion**: Respects `prefers-reduced-motion` setting
- **Flexible layout**: Adapts to container width constraints

## Accessibility Features

- **ARIA controls**: Toggle buttons properly control submenu visibility
- **Screen reader text**: Hidden text for submenu toggle context
- **Keyboard navigation**: Full keyboard support with proper focus states
- **Semantic markup**: Uses proper list structure for menu hierarchy
- **Active indicators**: Visual and programmatic current page identification

## No JavaScript behavior

If JavaScript is not available (slow connection, something breaks, etc) we use `@media (scripting: none)` to make the submenus usable by defaulting to an open state.

## Active Trail System

- **Current page**: Special styling and dot indicator for active links
- **Trail highlighting**: Parent items in active trail receive distinct styling
- **Auto-expansion**: Active trail submenus are open by default
