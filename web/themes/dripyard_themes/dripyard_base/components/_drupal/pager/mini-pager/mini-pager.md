# Mini Pager Component

A simplified pagination navigation component used throughout Drupal for basic pagination needs, especially in Views. Provides only previous, current page, and next navigation controls.

## Overview

The mini pager component renders a streamlined pagination interface with only essential navigation controls: previous, current page indicator, and next links. It depends on the full pager component for styling and provides a minimal alternative when full pagination controls are unnecessary.

## Usage

```twig
{{ include('dripyard_base:mini-pager', {
  pagination_heading_level: pagination_heading_level|default('h2'),
  items,
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `items` | object\|null | Yes | Collection of pagination items and current page |
| `pagination_heading_level` | string | Yes | HTML heading level for the pagination heading |

#### Items Object Structure
The `items` object contains:
- `previous` - Link to previous page (with href property)
- `next` - Link to next page (with href property)
- `current` - Current page number display

## CSS Custom Properties

The mini pager uses the same CSS variables as the full pager component:

- `--pager-surface` - Sets the background color of the pager container
- `--pager-inactive-background-color` - Controls background color for navigation controls
- `--pager-inactive-text-color` - Sets text color for navigation controls
- `--pager-active-background-color` - Controls background color for the current page indicator
- `--pager-active-text-color` - Sets text color for the current page indicator
- `--pager-border-radius` - Controls corner rounding of pager items
- `--pager-size` - Sets the size (width/height) of pager items
- `--pager-hover-background-color` - Controls background color on hover

## Container Queries

The component uses responsive sizing:

```css
@container (width > 700px) {
  --size: var(--spacing-l);
}
```

When the component is wider than 700px, pager items increase in size for better touch targets.

## Accessibility Features

### Semantic Structure
- **Navigation landmark**: Uses `<nav>` element with `aria-labelledby`
- **Hidden heading**: Includes visually hidden "Pagination" heading for screen readers
- **List structure**: Uses semantic `<ul>` and `<li>` elements for navigation items
- **Link relationships**: Includes `rel="prev"` and `rel="next"` attributes

### Screen Reader Support
- **Descriptive labels**: Previous and next controls have visually hidden descriptive text
- **Current page**: Clear indication of current page position
- **Control identification**: Previous and next controls clearly labeled for screen readers

### Keyboard Navigation
- **Focus management**: Inherits proper focus indicators from full pager styling
- **Tab order**: Logical keyboard navigation through available controls
- **Visual feedback**: Clear hover and focus states for interactive elements

### RTL Support
- **Bidirectional text**: SVG icons flip appropriately for right-to-left languages
- **Icon rotation**: Navigation arrows rotate correctly for directional navigation

### High Contrast Mode
- **Forced colors**: Inherits high contrast support from full pager component
- **Visual indicators**: Maintains visual distinction in high contrast environments

## Navigation Controls

### Simplified Interface
- **Previous only**: Shows previous control only when not on first page
- **Next only**: Shows next control only when not on last page
- **Current indicator**: Static display of current page number
- **No numbered pages**: Eliminates page number links for minimal interface

### Icon Implementation
- **SVG icons**: Uses same previous arrow icon for both directions
- **Icon rotation**: Next control rotates the previous icon 180 degrees
- **Scalable graphics**: Vector icons that inherit text color and scale properly

## Dependency Relationship

This component depends on the full pager component for styling. You can see this in the library overrides section of `mini-pager.component.yml`.

```yaml
libraryOverrides:
  dependencies:
    - core/components.dripyard-base--pager
```

The mini pager component inherits all CSS styles from the full pager but renders only a subset of the navigation controls.

## Related Components

- **Full Pager**: Complete pagination component that provides styling dependency
