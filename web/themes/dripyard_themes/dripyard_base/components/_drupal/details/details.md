# Details Component

A collapsible details disclosure widget that provides an expandable/collapsible content area with smooth CSS animations. This component is commonly used for form sections, FAQ items, and content organization.

**Technical Implementation Note:**
- Uses [`interpolate-size`](https://developer.mozilla.org/en-US/docs/Web/CSS/interpolate-size) to enable CSS-only open/close animations. Note this may not work on browsers that do not support this property.

**Accessibility Considerations:**
- Animations are disabled if user has `prefers-reduced-motion` enabled.

## Overview

The details component renders an HTML `<details>` element with enhanced styling and animations. It includes a clickable summary that toggles the visibility of nested content, with smooth height transitions and customizable styling.

## Usage

```twig
{% embed 'dripyard_base:details' with {
  title: 'Custom Content'
} %}
  {% block details_content %}
    <p>Your custom HTML content goes here</p>
    <ul>
      <li>List item 1</li>
      <li>List item 2</li>
    </ul>
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `title` | string | Yes | The summary text that appears as the clickable header |

### Slots

| Slot | Description |
|------|-------------|
| `details_content` | Main content area for custom HTML or form elements |


## CSS Custom Properties

The component uses the following CSS variables for customization:

- `--details-border-color` - Sets the border color around the details element
- `--details-border-radius` - Controls the corner rounding of the details element
- `--details-background-color` - Sets the background color of the details element
- `--details-text-color` - Controls the text color of the content area
- `--details-legend-text-color` - Sets the text color of the summary/title
- `--details-padding-block` - Controls the vertical padding inside the details element
- `--details-padding-inline` - Controls the horizontal padding inside the details element
- `--details-animation-duration` - Sets the duration of open/close animations

## Accessibility Features

### Motion Considerations
- **Respects user preferences**: Animations are disabled if user has `prefers-reduced-motion` enabled
- **Smooth transitions**: 200ms linear animations for comfortable interaction
