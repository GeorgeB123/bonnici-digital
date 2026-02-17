# Language Switcher Links Component

A simple list component that renders language links for the language switcher. Provides markup structure without styling, relying on the parent `language-switcher` component for visual appearance.

## Usage

```twig
{{ include('neonbyte:language-switcher-links', { links, attributes }, with_context = false) }}
```

### Props

| Property | Type | Description |
|----------|------|-------------|
| `links` | array | Array of language link objects with text, attributes, and link properties |

## Structure

Each link object in the `links` array should contain:

- `link` - Rendered link element (if language is available)
- `text` - Language text label
- `text_attributes` - Attributes for text-only items (current language)
- `attributes` - List item attributes

## Accessibility Features

- **Semantic markup**: Uses proper unordered list structure
- **Link attributes**: Preserves accessibility attributes from Drupal
- **Current language**: Handles active language state appropriately

## Integration

This component is designed to be used within the `language-switcher` component and inherits all styling from its parent. It provides clean separation between content structure and visual presentation.
