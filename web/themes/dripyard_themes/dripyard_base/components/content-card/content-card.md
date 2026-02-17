# Content Card Component

A simple content card component that displays a title, required link, optional metadata, horizontal divider, and body text in a clean card format.

## Usage

```twig
{{ include('dripyard_base:content-card', {
  title: 'Card Title',
  link_href: '/example-link',
  metadata: '20 March 2027',
  body_text: 'This is the body text content for the card. It supports HTML formatting.',
  background: true
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `title` | string | Yes | The card title text content |
| `link_href` | string | Yes | URL for the clickable title |
| `metadata` | string | No | Optional metadata text (e.g., date, category) |
| `body_text` | string | Yes | Body content supporting HTML formatting |
| `background` | boolean | No | Adds background color to the card |

## CSS Custom Properties

- `--content-card-border-radius` - Border radius for card corners (defaults to `var(--radius-sm)`)
- `--content-card-background` - Background color of the card (defaults to `var(--theme-surface)`)
- `--content-card-heading-color` - Color for the card title (defaults to `var(--theme-text-color-loud)`)
- `--content-card-body-color` - Color for the body text (defaults to `var(--theme-text-color-soft)`)
- `--content-card-padding` - Internal padding for card content (defaults to `0`, changes to `var(--spacing-xs)` when `background: true`)

## Background Variants

### Default (No Background)
- **Minimal styling**: No padding, transparent background with border
- **Clean appearance**: Simple border with rounded corners

### Background Enabled (`background: true`)
- **Enhanced styling**: Adds background color and internal padding
- **Background color**: Uses `var(--theme-surface-alt)` for subtle contrast
- **Content padding**: Adds `var(--spacing-xs)` padding around content
