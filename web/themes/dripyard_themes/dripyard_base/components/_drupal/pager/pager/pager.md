# Full Pager Component

A comprehensive pagination navigation component used throughout Drupal for navigating multi-page content, especially in Views. Provides complete navigation controls including first, previous, numbered pages, next, and last links.

## Overview

The full pager component renders a complete pagination interface with numbered page links, navigation controls, and ellipses for large page sets. It shares styling with the mini-pager component and serves as the base library dependency for pagination styling.

## Usage

```twig
{{ include('dripyard_base:pager', {
  pagination_heading_level: pagination_heading_level|default('h2'),
  items,
  current,
  ellipses,
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `items` | object\|null | Yes | Collection of pagination items and controls |
| `pagination_heading_level` | string | Yes | HTML heading level for the pagination heading |
| `current` | integer\|null | No | The currently active page number |
| `ellipses` | object\|null | No | Configuration for ellipses display |

#### Items Object Structure
The `items` object contains:
- `first` - Link to first page
- `previous` - Link to previous page
- `pages` - Object of numbered page links
- `next` - Link to next page
- `last` - Link to last page

#### Ellipses Object Structure
The `ellipses` object contains:
- `previous` - Boolean indicating if ellipses should show before current pages
- `next` - Boolean indicating if ellipses should show after current pages

## CSS Custom Properties

The component uses the following CSS variables for customization:

- `--pager-surface` - Sets the background color of the pager container
- `--pager-inactive-background-color` - Controls background color for inactive page items
- `--pager-inactive-text-color` - Sets text color for inactive page items
- `--pager-active-background-color` - Controls background color for the active page
- `--pager-active-text-color` - Sets text color for the active page
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
- **List structure**: Uses semantic `<ul>` and `<li>` elements for page items
- **Link relationships**: Includes `rel="prev"` and `rel="next"` attributes

### Screen Reader Support
- **Descriptive labels**: Each control has visually hidden descriptive text
- **Page context**: Current page and navigation context clearly announced
- **Control identification**: First, previous, next, and last controls clearly labeled

### Keyboard Navigation
- **Focus management**: Proper focus indicators with outline offset
- **Tab order**: Logical keyboard navigation through pagination controls
- **Visual feedback**: Clear hover and focus states for all interactive elements

### RTL Support
- **Bidirectional text**: SVG icons flip appropriately for right-to-left languages
- **Icon rotation**: Navigation arrows rotate correctly for directional navigation

### High Contrast Mode
- **Forced colors**: SVG icons use `linktext` color in high contrast mode
- **Visual indicators**: Maintains visual distinction in high contrast environments

## Navigation Controls

### Icon-Based Controls
- **First/Last**: Double arrow icons for jumping to extremes
- **Previous/Next**: Single arrow icons for adjacent navigation
- **SVG implementation**: Scalable vector icons that inherit text color
- **Icon rotation**: Next/last icons are rotated versions of previous/first

### Page Numbers
- **Current page**: Highlighted with distinct background and text colors
- **Clickable pages**: Standard page numbers with hover effects
- **Active state**: Visual distinction for current page location

### Ellipses
- **Visual indicators**: Shows `…` when pages are truncated
- **Role presentation**: Properly marked as presentational for screen readers
- **Contextual display**: Only shown when there are additional pages

## Shared Styling

This component serves as the base library for pagination styling. The mini-pager component depends on this component's CSS library for consistent styling across both pagination types.

## Related Components

- **Mini Pager**: Simplified pagination with only previous/next controls
- **Views**: Primary context where pagination is implemented
