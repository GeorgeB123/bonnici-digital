# Secondary Menu Component

A simple single-level navigation menu designed for the header third region. Provides horizontal navigation _without_ submenu support.

## Usage

```twig
{{ include('neonbyte:secondary-menu', { items }, with_context = false) }}
```

## CSS Custom Properties

- `--secondary-menu-link-color` - Text color for menu links
- `--secondary-menu-font-size` - Font size for menu text
- `--secondary-menu-border-radius` - Border radius for link hover state
- `--secondary-menu-link-hover-background` - Background for link hover state

## Accessibility Considerations

- Uses semantic list markup (`<ul>` and `<li>`) for proper navigation structure
- Links are keyboard accessible with focus states
- Screen readers can navigate the menu structure using list navigation
- Hover states provide visual feedback for interactive elements

## Slots and Props

### Props
- `items` (required) - Menu items array/object from Drupal menu system
