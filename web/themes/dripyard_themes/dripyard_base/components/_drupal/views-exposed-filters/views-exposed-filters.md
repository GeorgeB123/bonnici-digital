# Views Exposed Filters Component

A wrapper component for styling and organizing Drupal's Views exposed filter forms with consistent visual presentation and responsive behavior.

## Overview

The views exposed filters component provides a styled container for Views exposed filter forms, creating a cohesive visual treatment for filtering controls. It wraps the exposed filter content with consistent styling and layout classes.

## Usage

```twig
{% embed 'dripyard_base:views-exposed-filters' %}
  {% block content %}
    {{ exposed }}
  {% endblock %}
{% endembed %}
```

### Slots

| Slot | Description |
|------|-------------|
| `content` | Main content area for exposed filter form elements |

## CSS Custom Properties

The component uses the following CSS variables for customization:

- `--views-exposed-filters-background-color` - Sets the background color of the filter container
- `--views-exposed-filters-text-color` - Controls the text color within the filter area
- `--views-exposed-filters-padding-block` - Controls vertical padding inside the container
- `--views-exposed-filters-padding-inline` - Controls horizontal padding inside the container
- `--views-exposed-filters-border-radius` - Sets the corner rounding of the container

## Accessibility Features

### Semantic Structure
- **Form wrapper**: Provides semantic container for form elements
- **Inline form styling**: Uses `form--inline` class for horizontal form layouts

### Visual Design
- **Consistent styling**: Standardized appearance across all Views with exposed filters
- **Theme integration**: Uses theme color variables for consistent visual integration
- **Container boundaries**: Clear visual boundaries with background color and border radius
