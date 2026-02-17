# Text Component

A very basic component to display some text with minimal styling.

## Usage

```twig
{{ include('dripyard_base:text', {
  text: 'Your text content here',
  style: 'body_m',
  color: 'medium',
  center: false,
  text_max_width: '800px',
  modifier_classes: 'custom-class'
}, with_context = false) }}
```

## Accessibility Considerations

- Uses a basic `<div>` wrapper with semantic class name
- Text content is rendered directly without additional markup modifications
- Inherits all accessibility features from the provided text content
- Relies on proper heading hierarchy and semantic markup from parent components

## Props

| Property | Type | Required | Default | Description |
|----------|------|----------|---------|-------------|
| `text` | string | No | - | The text content to display (HTML content is supported) |
| `style` | string | **Yes** | - | Text size style: `body_l` (Large), `body_m` (Medium), `body_s` (Small) |
| `color` | string | **Yes** | `inherit` | Text color variant: `inherit`, `soft`, `medium`, `loud`, `primary` |
| `center` | boolean | No | - | Boolean to center align the text |
| `text_max_width` | string | No | - | Maximum width constraint: `400px`, `600px`, `800px`, `1000px`, `1200px`, `1400px` |
| `modifier_classes` | string | No | - | Additional CSS classes to apply to the component |
