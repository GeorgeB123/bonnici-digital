# Menu Block Component

A semantic navigation container for menu items with accessibility features, optional title display, and theme support.

## Usage

```twig
{{ include('dripyard_base:menu-block', {
  title: 'Navigation Menu',
  show_title: true,
  content: menu_content,
  theme: 'light',
  title_attributes: title_attributes,
  title_suffix: title_suffix
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `title` | string | Yes | Menu title for accessibility labeling |
| `show_title` | boolean | No | Whether to visually display the title |
| `theme` | string | No | Theme variant: inherit, white, light, dark, black, primary |
| `title_attributes` | object | No | Additional attributes for the title element |
| `title_suffix` | string | No | Content to display after the title |

### Slots

| Slot | Description |
|------|-------------|
| `content` | Menu content and navigation items |

## Accessibility Features

- **Semantic navigation**: Uses `<nav>` element for proper landmark
- **ARIA labeling**: Navigation labeled by title via `aria-labelledby`
- **Screen reader support**: Title can be hidden visually but remain accessible
- **Heading structure**: Uses h2 element with h3 styling for proper hierarchy
- **Unique IDs**: Generates unique IDs for proper ARIA relationships

## Title Behavior

- **Visible title**: Standard display when `show_title` is true
- **Hidden title**: Uses `visually-hidden` class when `show_title` is false
- **Always accessible**: Title always present for screen readers regardless of visibility
- **Styling**: Uses h3 visual styling on h2 semantic element

## Theme Integration

- **Conditional theming**: Background and padding only applied when theme is set
- **Rounded corners**: Themed containers use medium border radius
- **Background**: Uses theme surface color for container background
- **Text color**: Title uses loud theme text color for emphasis
