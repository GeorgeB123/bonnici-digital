# Skip Link Component

An accessibility navigation component that provides keyboard users with a way to bypass repetitive content and jump directly to the main content area.

## Overview

The skip link component appears in the top left of the page and is only visible when it receives focus through keyboard navigation. It allows users to skip past navigation menus and other repetitive content, providing direct access to the main content area.

## Usage

```twig
{{ include('dripyard_base:skip-link', {
  href: '#main-content',
  text: 'Skip to main content'|t,
}, with_context: false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `href` | string | Yes | URI reference to the target element (usually `#main-content`) |
| `text` | string | Yes | The link text displayed to users |

## CSS Custom Properties

The component uses the following CSS variable for customization:

- `--theme-focus-ring-color` - Controls the color of the focus ring when the skip link receives focus

## Accessibility Features

### Keyboard Navigation
- **Focus-only visibility**: Hidden by default, becomes visible only when focused via keyboard
- **High visibility**: Prominent styling ensures the link is clearly visible when focused
- **Tab order**: First focusable element in the page tab sequence
- **Direct navigation**: Provides immediate access to main content without tabbing through navigation

### Visual Design
- **High contrast**: Uses theme's loudest text color on surface background for maximum visibility
- **Clear boundaries**: Rounded corners and padding create distinct visual boundaries
- **Positioning**: Absolutely positioned to avoid layout shifts when becoming visible

### Screen Reader Support
- **Descriptive text**: Link text clearly describes the action (e.g., "Skip to main content")
- **Semantic HTML**: Uses standard anchor element for consistent screen reader behavior
- **Target identification**: Links to properly identified landmark or heading elements

### RTL Support
- **Bidirectional positioning**: Automatically adjusts position for right-to-left languages
- **Layout preservation**: Maintains appropriate positioning regardless of text direction

## Positioning Behavior

### Absolute Positioning
The skip link uses absolute positioning that respects Drupal's displacement system:

### Hidden State
When not focused, the link is visually hidden but remains in the DOM:

### Focus State
When focused, all hiding properties are reverted to make the link fully visible:
