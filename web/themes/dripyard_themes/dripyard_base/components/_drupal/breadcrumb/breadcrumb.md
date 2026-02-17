# Breadcrumb Component

A responsive breadcrumb navigation component for Drupal that provides users with hierarchical navigation context and a path back to parent pages.

## Overview

The breadcrumb component displays a horizontal navigation trail showing the user's location within the site hierarchy. It includes responsive behavior that collapses to show only the first and last breadcrumb items on smaller screens.

## Usage

```twig
{{ include('dripyard_base:breadcrumb', {
  breadcrumb_heading,
  breadcrumb,
}, with_context = false) }}
```

## CSS Custom Properties

The component uses the following CSS variables for customization:

- `--breadcrumb-font-size` - Controls the text size of breadcrumb items
- `--breadcrumb-font-weight` - Sets the font weight for breadcrumb text
- `--breadcrumb-text-color` - Controls the default text color for breadcrumb items
- `--breadcrumb-link-color` - Sets the color for breadcrumb links
- `--breadcrumb-link-color-hover` - Sets the color for breadcrumb links on hover and focus
- `--breadcrumb-border-color` - Controls the color of breadcrumb separators

## Accessibility Features

- **ARIA Navigation**: Uses `<nav>` element with `aria-labelledby` attribute
- **Screen Reader Support**: Includes visually hidden heading "Breadcrumb"
- **Semantic HTML**: Uses `<ol>` (ordered list) to represent hierarchical structure
- **Color Contrast**: Ensures 4.5:1 contrast ratio for text colors
- **Forced Colors Support**: Respects high contrast mode preferences
- **Focus Management**: Proper focus styles for keyboard navigation

## Container Queries

The component uses container queries for responsive behavior:

```css
@container (width < 600px) {
  /* Mobile-specific styles */
}
```

This allows the breadcrumb to adapt based on its container width rather than viewport width.
