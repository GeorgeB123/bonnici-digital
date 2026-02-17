# Header Search Component

A responsive search component that functions as a dropdown at wide widths and integrates with the mobile menu at narrow widths. Compatible with Drupal core search and Search API module.

## Usage

```twig
{{ include('neonbyte:header-search', {
  attributes: attributes,
  content: search_form
}, with_context = false) }}
```

### Slots

| Slot | Description |
|------|-------------|
| `content` | Search form content from Drupal block |

## CSS Custom Properties

- `--header-search-background` - Background color for dropdown (default: transparent)
- `--header-search-text-color` - Text color on background
- `--header-search-padding-block` - Vertical padding for search content
- `--header-search-font-size` - Font size for search input (default: 22px)

## Responsive Behavior

The component adapts to screen width at **1000px** breakpoint:

- **Desktop (>1000px)**: Dropdown overlay with trigger button
- **Mobile (≤1000px)**: Integrated into mobile menu layout
- **Progressive enhancement**: Functional with CSS-only fallback

## JavaScript Features

- **Auto-focus**: Search input receives focus when opened
- **Keyboard support**: Escape key closes dropdown
- **Focus management**: Proper focus handling on open/close
- **Integration**: Coordinates with other header dropdowns

## No JavaScript behavior

If JavaScript is not available (slow connection, something breaks, etc) we use `@media (scripting: none)` to make the search usable.

## Accessibility Features

- **ARIA states**: Uses `aria-expanded` for dropdown state
- **Semantic HTML**: Uses `<search>` element for proper structure
- **Keyboard navigation**: Full keyboard support with focus management
- **Screen reader support**: Hidden text for trigger button
- **High contrast**: Adapts button styling for forced colors mode
