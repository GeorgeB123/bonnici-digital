# Accordion Group Component

A container component for organizing multiple accordion items with theme support and visual variations. Designed to work with the theme system for visually distinct styles and supports different layout variations.

## Overview

The accordion group component provides a structured container for multiple accordion items with support for theme variations and visual layout options. It uses a grid-based layout for organizing accordion items with configurable spacing and borders.

## Video

YouTube: https://youtu.be/YXf9PH2hbYs

## Usage

```twig
{% embed 'dripyard_base:accordion-group' with {
  variation: 'borders'
} %}
  {% block accordion_group_content %}
    {# Accordion items go here #}
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Options | Description |
|----------|------|---------|-------------|
| `variation` | string | `background-color`, `borders` | Required. Visual variation that affects layout and styling. `borders` removes gap between items. Default: `background-color` |

### Slots

| Slot | Description |
|------|-------------|
| `accordion_group_content` | Main content area for accordion items arranged in a grid layout |

## Accessibility Features

- **Section element**: Uses `<section>` with `role="group"` for proper content grouping
- **Theme integration**: Maintains proper color contrast through theme variables
- **Semantic structure**: Provides proper sectioning for screen readers

### Visual Variations

#### Background Color Variation
- Standard layout with spacing between items
- Uses theme colors for background and text

#### Borders Variation
- Removes gap between accordion items for seamless borders
- Items appear connected without spacing
