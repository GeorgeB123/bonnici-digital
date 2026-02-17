# Basic Section Component

A flexible section wrapper component that provides theme support, responsive container behavior, and spacing control. Designed as a lightweight alternative to the Dynamic Layout component for simple content sections that don't require complex grid layouts.

## Usage

```twig
{% embed 'dripyard_base:section' with {
  section_width: 'edge-to-edge',
  content_width: 'max-width',
  margin_top: 'zero',
  margin_bottom: 'zero',
  padding_top: 'large',
  padding_bottom: 'large',
  theme: 'light'
} only %}
  {% block header %}
    <h2>Section Header</h2>
    <p>Optional header content for the section</p>
  {% endblock %}

  {% block content %}
    <p>Main section content goes here.</p>
    <p>This can include any HTML or other components.</p>
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Default | Description |
|----------|------|----------|---------|-------------|
| `section_width` | string | **Yes** | - | Section width: `edge-to-edge` (full screen width) or `max-width` (constrained) |
| `content_width` | string | **Yes** | - | Content width: `edge-to-edge`, `max-width`, or `narrow` |
| `margin_top` | string | **Yes** | - | Top margin: `zero`, `small`, `medium`, `large` |
| `margin_bottom` | string | **Yes** | - | Bottom margin: `zero`, `small`, `medium`, `large` |
| `padding_top` | string | **Yes** | - | Top padding: `zero`, `small`, `medium`, `large` |
| `padding_bottom` | string | **Yes** | - | Bottom padding: `zero`, `small`, `medium`, `large` |
| `theme` | string | No | `inherit` | Theme variant: `inherit`, `white`, `light`, `dark`, `black`, `primary` |
| `additional_classes` | string | No | - | Additional CSS classes for custom styling (separated by spaces) |

### Slots

| Slot | Description |
|------|-------------|
| `header` | Optional header content displayed above the main content area |
| `content` | Main content area of the section |

## Width Control

### Section Width
Controls the outer container behavior:
- **edge-to-edge**: Section spans full viewport width with no outer constraints
- **max-width**: Section is constrained to the theme's maximum width with centered alignment

### Content Width
Controls the inner content container behavior:
- **edge-to-edge**: Content spans the full section width
- **max-width**: Content is constrained to the theme's maximum width (adds container if section is edge-to-edge)
- **narrow**: Content uses a narrower width for improved readability

## Spacing System

### Margin Control
External spacing around the section component:
- **zero**: No margin (0px)
- **small**: Small margin using layout utilities (`var(--spacing-m)`)
- **medium**: Medium margin using layout utilities (`var(--spacing-component-internal)`)
- **large**: Large margin using layout utilities (`var(--spacing-component)`)

### Padding Control
Internal spacing within the section:
- **zero**: No padding (0px)
- **small**: Small padding using layout utilities (`var(--spacing-m)`)
- **medium**: Medium padding using layout utilities (`var(--spacing-component-internal)`)
- **large**: Large padding using layout utilities (`var(--spacing-component)`)

*Note: Spacing values are controlled by CSS custom properties from the layout utilities and may be customized by themes.*

## Theme Support

The Basic Section component provides full theme integration:

### Theme Variants
- **inherit**: No specific theme styling (transparent background)
- **white**: White background theme
- **light**: Light background theme
- **dark**: Dark background theme
- **black**: Black background theme
- **primary**: Primary brand color theme

### Theme Features
- **Background colors**: Uses `var(--theme-surface)` for consistent theme backgrounds
- **Text colors**: Applies `var(--theme-text-color-medium)` for optimal contrast
- **Border radius**: Supports theme-consistent border radius styling
- **Stacked sections**: Automatically removes border radius between adjacent sections of the same theme

## Responsive Behavior

The section component uses container queries and responsive CSS for optimal display:

## CSS Custom Properties

- `--dy-section-padding-block`: Default vertical padding for the section
- `--dy-section-padding-inline`: Default horizontal padding for the section
- `--dy-section-border-radius`: Border radius for the section container

## Best Practices

### When to Use Basic Section
- **Simple content layouts**: Use for straightforward content that doesn't need complex grid layouts
- **Theme wrappers**: When you need themed backgrounds with consistent spacing
- **Header/content patterns**: When you have optional header content above main content
- **Responsive containers**: When you need flexible width control without grid complexity

### Content Organization
- Use the header slot for titles, subtitles, and introductory content
- Place main content in the content slot for proper spacing and structure
- Combine with Grid Wrapper components when you need grid layouts within the section

### Theme Considerations
- Choose themes that provide adequate contrast for your content
- Use consistent themes across related sections for visual harmony
- Test content readability across all theme variants you plan to use

## Performance

- **Lightweight**: Minimal CSS and no JavaScript dependencies
- **Container queries**: Modern responsive behavior without media query overhead
- **CSS custom properties**: Efficient theming and customization system
- **Background optimization**: Optimized for background image components

## Related Components

- **Grid Wrapper**: Use within section content when you need 12-column grid layouts
- **Grid Cell**: Can be used within Grid Wrapper components inside sections
