# Local Actions Component

A navigation component for Drupal's local action tabs that provides primary and secondary action groupings with active state management and responsive design.

## Overview

The local actions component (also known as tabs) displays navigation elements for page-level actions in Drupal. It supports both primary and secondary action groups with visual indicators for active states. In Dripyard Base, this component is placed in the `fixed_middle_right` region by default so it does not displace the hero, though this component works in all regions.

## Usage

### Local Actions Container
```twig
{{ include('dripyard_base:local-actions', {
  primary: primary_actions,
  secondary: secondary_actions
}, with_context = false) }}
```

### Props

#### Local Actions (Container)
| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `primary` | array | Yes | Array of primary action items |
| `secondary` | array | No | Array of secondary action items |

#### Local Action (Individual)
| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `is_active` | boolean | No | Whether this action is currently active |
| `link` | object | No | Link object containing URL and text |

## CSS Custom Properties

The component uses the following CSS variables for customization:

- `--local-actions-height` - Sets the height of action tabs
- `--local-actions-padding-inline` - Controls horizontal padding within tabs
- `--local-actions-active-border-size` - Sets the size of the active state border indicator
- `--local-actions-highlight-color` - Controls the color of active state highlighting
- `--local-actions-text-color` - Sets the default text color for tabs
- `--local-actions-text-color-active` - Controls text color for active/hovered tabs
- `--local-actions-letter-spacing` - Sets letter spacing for tab text
- `--local-actions-font-size` - Controls the font size of tab text
- `--local-actions-background-color` - Sets the default background color
- `--local-actions-background-color-hover` - Controls background color on hover
- `--local-actions-background-color-active` - Sets background color for active tabs
- `--local-actions-border-width` - Controls the width of tab borders
- `--local-actions-border-color` - Sets the color of tab borders
- `--local-actions-transition-duration` - Controls animation timing for state changes

## Accessibility Features

### Semantic Structure
- **Navigation landmarks**: Uses `<nav>` elements for proper screen reader navigation
- **Hidden headings**: Includes visually hidden headings for action groups
- **ARIA labeling**: Proper `aria-labelledby` attributes for navigation context
- **List structure**: Uses semantic `<ul>` and `<li>` elements

### Keyboard Navigation
- **Focus management**: Proper focus indicators with z-index stacking
- **Tab order**: Logical keyboard navigation through action items
- **Focus visibility**: Enhanced focus states for keyboard users

### Visual Accessibility
- **Color contrast**: Text colors meet accessibility requirements
- **Active indicators**: Multiple visual cues for active states (color, weight, border)
- **Hover feedback**: Clear interactive feedback for all action states

## Secondary Actions

Secondary actions have reduced visual prominence:
- **Transparent backgrounds**: No background color by default
- **Separate grouping**: Distinct navigation section with spacing
- **Same interaction patterns**: Consistent hover and focus behavior
