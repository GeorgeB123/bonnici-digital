# Heading Component

A simple, semantic heading component that generates HTML heading elements with consistent styling and customizable heading levels.

## Usage

```twig
{{ include('dripyard_base:heading', {
  text: 'Section Title',
  html_element: 'h2',
  style: 'h2',
  color: 'default',
  center: false,
  text_max_width: '800px',
  margin_top: 'zero',
  margin_bottom: 'zero',
  modifier_classes: 'heading-large'
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `text` | string | Yes | The heading text content |
| `html_element` | string | Yes | HTML element type: `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `p`, `div`, `span` |
| `style` | string | Yes | Visual style: `title`, `h1`, `h2`, `h3`, `h4`, `h5`, `h6`, `body_l`, `body_m`, `body_s` (default: `h2`) |
| `color` | string | No | Text color: `default`, `soft`, `medium`, `loud`, `primary` |
| `center` | boolean | No | Center align the text (default: false) |
| `text_max_width` | string | No | Maximum width constraint: `400px`, `600px`, `800px`, `1000px`, `1200px`, `1400px` |
| `margin_top` | string | Yes | Top margin: `zero`, `small`, `medium`, `large` (default: `zero`)|
| `margin_bottom` | string | Yes | Bottom margin: `zero`, `small`, `medium`, `large` (default: `zero`)|
| `modifier_classes` | string | No | Additional CSS classes for styling variations |

## HTML Elements

The component supports various HTML elements via the `html_element` prop:

### Semantic Headings
- **h2-h6**: Standard HTML heading elements for proper semantic structure
- **h1**: Available but typically reserved for page titles

### Non-semantic Elements
- **p**: Paragraph element for heading-styled text without semantic meaning
- **div**: Generic block element
- **span**: Inline element for heading-styled text

## Visual Styles

The `style` prop controls the visual appearance independent of the HTML element:

- **title**: Large, prominent heading style
- **h1-h6**: Heading size styles (h1 largest, h6 smallest)
- **body_l/body_m/body_s**: Body text sizes (large/medium/small)

## Styling

### Color Variations
The `color` prop provides semantic color options:
- **default**: Standard text color
- **soft**: Muted/subdued text color
- **medium**: Medium emphasis text color
- **loud**: High emphasis text color
- **primary**: Primary brand color

### Spacing Control
Margin props provide precise spacing control:
- **zero**: No margin
- **small/medium/large**: Incremental spacing sizes

### Additional Styling
- **Reset margins**: All headings have `margin: 0` for consistent spacing control
- **Theme integration**: Uses theme color variables for consistent appearance
- **Modifier support**: Additional classes can be applied for styling variations

## Accessibility Features

- **Semantic HTML**: Uses proper HTML heading elements (h2-h5)
- **Logical hierarchy**: Supports standard heading level structure
- **Screen reader friendly**: Proper heading markup aids navigation
- **Color contrast**: Uses theme color variables that meet accessibility standards

## Best Practices

- **Heading hierarchy**: Use levels in logical order without skipping
- **Page structure**: Reserve h1 for page titles, start content headings at h2
- **Consistent styling**: Use modifier classes for visual variations while maintaining semantic meaning
