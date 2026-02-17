# Language Switcher Component

A responsive language selection component that functions as a dropdown at wide widths and a disclosure within the mobile menu at narrow widths.

## Usage

```twig
{{ include('neonbyte:language-switcher', { content }, with_context = false) }}
```

### Slots

| Slot | Description |
|------|-------------|
| `content` | Language links content from Drupal block |

## CSS Custom Properties

- `--language-switcher-icon-color` - Color for globe icon and trigger elements
- `--language-switcher-link-color` - Color for language links
- `--language-switcher-background-color-hover` - Background color on link hover
- `--language-switcher-link-color-active` - Text color for active language
- `--language-switcher-background-color-active` - Background color for active language

## Responsive Behavior

The component adapts to screen width at **1000px** breakpoint:

- **Desktop (>1000px)**: Dropdown overlay with globe icon trigger
- **Mobile (≤1000px)**: Disclosure button with chevron indicator
- **Progressive enhancement**: Functional with CSS-only fallback

## Layout Adaptations

- **Many languages**: Switches to grid layout when 11+ languages present
- **Flexible wrapping**: Language links wrap naturally in available space
- **Container queries**: Adapts layout based on content requirements

## JavaScript Features

- **Toggle interaction**: Click to open/close language selection
- **Keyboard support**: Escape key closes dropdown
- **Focus management**: Proper focus handling on state changes
- **Integration**: Coordinates with other header dropdowns

## No JavaScript behavior

If JavaScript is not available (slow connection, something breaks, etc) we use `@media (scripting: none)` to make the language switcher usable.

## Accessibility Features

- **ARIA states**: Uses `aria-expanded` for dropdown state
- **Semantic markup**: Proper button and list structure
- **Keyboard navigation**: Full keyboard support with focus management
- **Screen reader support**: Hidden text for desktop trigger
- **Visual indicators**: Chevron and close icon state changes
