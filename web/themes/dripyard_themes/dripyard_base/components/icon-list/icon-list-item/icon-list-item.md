# Icon List Item Component

An individual item component designed for use within `icon-list` components. Features an icon, text content, and optional link functionality.

## Usage

```twig
{{ include('dripyard_base:icon-list-item', {
  icon: 'check',
  text: 'All of our themes are built to WCAG 2.2 AA standards.',
  href: '/accessibility'
}, with_context = false) }}
```

### Basic item without link

```twig
{{ include('dripyard_base:icon-list-item', {
  icon: 'shield',
  text: 'Security-first development approach with regular updates.'
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `icon` | string | Yes | Icon name from FontAwesome set |
| `text` | string | Yes | Text content for the list item |
| `href` | string | No | Link URL (uri-reference format) - makes the text clickable |

## Content Structure

- **Icon**: Rendered using the theme's icon component
- **Text content**: Wrapped in content container for proper styling
- **Optional link**: When href is provided, text becomes clickable

## CSS Custom Properties

### Typography and Sizing
- `--icon-list-font-size` - Font size for list item text (defaults based on parent size setting)
- `--icon-list-icon-size` - Size of the icon (defaults based on parent size setting)
- `--icon-list-gap` - Spacing between icon and text content
- `--icon-list-icon-color` - Color of the icon (defaults based on parent icon_color setting)

### Size Variants (inherited from parent icon-list)
- **Small**: `--icon-list-font-size: var(--body-m-size)`, `--icon-list-icon-size: var(--sp3)`, `--icon-list-gap: var(--sp2-5)`
- **Medium**: `--icon-list-font-size: var(--body-l-size)`, `--icon-list-icon-size: var(--sp3)`, `--icon-list-gap: var(--sp3)`
- **Large**: `--icon-list-font-size: var(--h4-size)`, `--icon-list-icon-size: var(--sp6)`, `--icon-list-gap: var(--sp3)`

### Icon Color Variants (inherited from parent icon-list)
- **Primary**: `--icon-list-icon-color: var(--theme-text-color-primary)`
- **Secondary**: `--icon-list-icon-color: var(--theme-text-color-secondary)`
- **Normal**: `--icon-list-icon-color: var(--theme-text-color-medium)`

## Usage Guidelines

- **Parent dependency**: Should only be used within icon-list components
