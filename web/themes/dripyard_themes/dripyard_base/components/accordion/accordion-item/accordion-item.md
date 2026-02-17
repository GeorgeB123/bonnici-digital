# Accordion Item Component

An individual collapsible content item designed for use within accordion groups. Provides expandable content sections with smooth animations and accessible interaction patterns.

## Overview

The accordion item component creates individual collapsible sections using native HTML `<details>` elements enhanced with custom styling and animations. Each item can hold any type of content and is designed to work seamlessly within accordion group containers.

## Video

YouTube: https://youtu.be/YXf9PH2hbYs

## Usage

```twig
{% embed 'dripyard_base:accordion-item' with {
  title: 'Section Title'
} %}
  {% block accordion_item_content %}
    <p>Your accordion content goes here</p>
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `title` | string | Yes | The title text displayed in the accordion header |
| `open` | boolean | No | Whether the item is open by on page load |

### Slots

| Slot | Description |
|------|-------------|
| `accordion_item_content` | Content area that can hold any type of data or markup |

## CSS Custom Properties

The component uses the following CSS variables for customization:

- `--accordion-item-border-color` - Sets the border color around the accordion item
- `--accordion-item-border-radius` - Controls the corner rounding of the accordion item
- `--accordion-item-background-color` - Sets the background color of the accordion item
- `--accordion-item-text-color` - Controls the text color within the accordion item
- `--accordion-item-title-text-color` - Controls the text color within the summary
- `--accordion-item-padding-block` - Controls vertical padding inside the accordion item
- `--accordion-item-padding-inline` - Controls horizontal padding inside the accordion item
- `--accordion-item-animation-duration` - Sets the duration of expand/collapse animations
- `--accordion-item-title-font-size` - Controls the font size of the accordion title

## Accessibility Features

### Semantic Structure
- **Native details**: Uses HTML `<details>` and `<summary>` elements for proper accessibility
- **Screen reader support**: Native elements provide built-in screen reader announcements
- **Keyboard navigation**: Standard keyboard interaction (Space/Enter to toggle)

### Motion Considerations
- **Reduced motion**: Animations are disabled when users prefer reduced motion
- **Smooth transitions**: 0.2s animation duration for comfortable interaction (for browsers that support `interpolate-size`)
- **Progressive enhancement**: Uses modern CSS features with fallbacks

### Slot Capabilities
The `accordion_item_content` slot can hold any type of content:

- **Rich text**: Paragraphs, lists, and formatted content
- **Media**: Images, videos, and embedded content
- **Forms**: Form elements and interactive components
- **Nested components**: Other components and complex layouts

## Related Components

- **Accordion Group**: Container component that organizes multiple accordion items
