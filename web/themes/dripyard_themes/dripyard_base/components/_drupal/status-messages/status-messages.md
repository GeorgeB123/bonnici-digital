# Status Messages Component

A notification system component for displaying Drupal's status messages including informational, success, warning, and error messages with interactive features and toast-style animations.

## Overview

The status messages component renders system notifications with four distinct message types: informational, success, warning, and error. In Dripyard Base, status messages are placed in the `fixed_bottom_right` region by default, creating a toast-style effect on load, though they can be placed in any region.

## Usage

This component is automatically rendered by Drupal's messaging system. The template receives message data through Drupal's standard message variables:

```twig
{{ include('dripyard_base:status-messages', {
  attributes,
  type,
  message_list,
  status_headings,
}, with_context = false) }}
```

### Props

The component receives data through Drupal's standard message system variables:

| Variable | Type | Description |
|----------|------|-------------|
| `message_list` | object | Collection of messages organized by type |
| `status_headings` | object | Heading text for each message type |
| `attributes` | object | HTML attributes for message containers |

### Message Types

The component supports four message types:
- **Error** - Critical issues requiring immediate attention
- **Warning** - Important notices that need user awareness
- **Status** - Success confirmations and positive feedback
- **Info** - General informational messages

## CSS Custom Properties

The component uses the following CSS variables for customization:

- `--messages-icon-size` - Sets the size of message type icons
- `--messages-surface` - Controls the background color of message containers
- `--messages-text` - Sets the text color for message content
- `--messages-border-radius` - Controls corner rounding of message containers

## Container Queries

The component uses container queries for responsive behavior:

```css
@container (width < 300px) {
  .messages__container {
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 10px;
  }

  .messages__content {
    order: 2;
    flex-basis: 100%;
  }
}
```

On narrow containers (less than 300px), the layout switches to a wrapped flexbox with the content taking full width.

## Accessibility Features

### Semantic Structure
- **ARIA labels**: Each message container includes appropriate `aria-label` attributes
- **Role alerts**: Error messages include `role="alert"` for immediate screen reader announcement
- **Hidden headings**: Visually hidden headings provide context for each message type
- **List semantics**: Multiple messages use proper `<ul>` and `<li>` structure

### Screen Reader Support
- **Type identification**: Message types are clearly announced through hidden headings
- **Alert notifications**: Error messages trigger immediate screen reader alerts
- **Close button labels**: Dismissal buttons include descriptive text for screen readers
- **Icon descriptions**: SVG icons are properly implemented for assistive technology

### Keyboard Navigation
- **Focusable controls**: Close buttons are properly focusable with keyboard navigation
- **Focus indicators**: Clear outline styles for keyboard focus states
- **Dismissal interaction**: Messages can be dismissed using standard button interaction

### Motion Considerations
- **Reduced motion**: Animations are disabled when users prefer reduced motion
- **Graceful fallback**: Messages are immediately removed without animation when motion is reduced
- **Smooth transitions**: 0.2s transition duration for comfortable animation timing

## Interactive Features

### Close Functionality
The component includes JavaScript-powered close buttons:

- **Automatic button addition**: Close buttons are dynamically added to each message
- **Smooth dismissal**: Messages animate out before removal when motion is supported
- **Immediate removal**: Messages are instantly removed when reduced motion is preferred
- **Event handling**: Proper cleanup with transition event listeners

### Animation System
- **CSS-only animations**: Uses modern CSS features for smooth height transitions
- **Progressive enhancement**: Enhanced animations only for supporting browsers
- **Interpolate-size support**: Leverages `interpolate-size: allow-keywords` for height animations

### JavaScript Theme Integration
The component integrates with Drupal's theming system for dynamic message injection:

- **Theme function**: Uses `dripyard_base/js/message.theme.js` for JavaScript-generated messages
- **Library dependency**: The `dripyard_base/drupal.message` library extends core's `core/drupal.message` library
- **Duplicate markup**: The JavaScript theme function duplicates Twig markup - changes to the template require corresponding updates to the JavaScript file

## Visual Design

### Message Styling
- **Type-specific icons**: Each message type displays a distinctive SVG icon
- **Color coding**: Icons use semantic colors (error red, warning orange, success green, info blue)
- **Consistent spacing**: Standardized padding and margins throughout
- **Flexible layout**: Responsive design adapts to various container sizes

### High Contrast Support
- **Forced colors**: Icons automatically adapt to high contrast mode using `canvasText`
- **Color independence**: Message clarity maintained regardless of color scheme
- **Focus visibility**: Enhanced focus indicators work in all contrast modes

## Toast-Style Positioning

When placed in the `fixed_bottom_right` region, messages exhibit toast-like behavior:

- **Non-intrusive placement**: Messages appear without disrupting main content
- **Stacking behavior**: Multiple messages stack vertically with appropriate spacing
- **Automatic spacing**: Consistent gaps between successive messages

## Library Dependencies

The status messages component has important library relationships within the Dripyard Base theme:

- **Global theme dependency**: Dripyard Base's global library depends on the auto-generated library from this component
- **Core integration**: The component extends Drupal's core messaging system
