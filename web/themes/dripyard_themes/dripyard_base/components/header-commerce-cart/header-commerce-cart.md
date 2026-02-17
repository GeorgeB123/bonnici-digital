# Header Commerce Cart Component

A header shopping cart component that displays a cart icon with item count and supports optional dropdown functionality for displaying cart contents in wide viewports.

## Usage

```twig
{{ include('dripyard_base:header-commerce-cart', {
  url: '/cart',
  icon_url: '',
  count: 3,
  count_text: 'items',
  content: cart_items_markup,
  links: cart_links_markup,
  dropdown: true
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `url` | string | Yes | Cart page URL destination |
| `icon_url` | string | No | Custom cart icon URL (defaults to 'images/shopping-cart.svg') |
| `count` | integer | No | Number of items in cart |
| `count_text` | string | No | Descriptive text for item count |
| `content` | string | No | HTML markup for cart items in dropdown |
| `links` | string | No | HTML markup for cart action links |
| `dropdown` | boolean | No | Enable dropdown functionality (default: false) |

## Features

### Responsive Behavior
- **Mobile/Narrow viewports**: Shows as simple cart link only
- **Wide viewports (> 1000px)**: Can display dropdown functionality when enabled
- **Container query responsive**: Uses CSS container queries for adaptive layout

### Dual Display Modes
- **Link mode**: Always visible cart link for direct navigation to cart page
- **Dropdown mode**: Interactive dropdown button for cart contents preview (wide viewports only)

### Accessibility
- **ARIA attributes**: Proper `aria-expanded` and `aria-controls` for dropdown state
- **Screen reader support**: Visually hidden text for item count ("items")
- **Keyboard navigation**: Full keyboard support with Enter/Space activation and Escape to close
- **Focus management**: Intelligent focus handling for dropdown interactions

## JavaScript Functionality

The component includes interactive JavaScript for dropdown management:

### Event Handling
- **Click events**: Toggle dropdown visibility on button click
- **Keyboard events**: Escape key closes dropdown
- **Focus events**: Auto-close when focus leaves cart area (with Safari compatibility delay)

### Integration
- **Global state management**: Integrates with `Drupal.dripyard.closeCart()` API
- **Cross-component coordination**: Automatically closes other navigation dropdowns when opened

## CSS Custom Properties

### Layout Variables
- `--header-commerce-cart-dropdown-border-radius` - Dropdown corner rounding
- `--header-commerce-cart-dropdown-padding` - Dropdown internal spacing
- `--header-commerce-cart-dropdown-drop-shadow` - Dropdown shadow effect

## Block Configuration

- **Drupal integration**: Block has option to "Display cart contents in a dropdown" within block configuration
- **Conditional dropdown**: Dropdown functionality only applies at wide widths (> 1000px)
- **Fallback behavior**: Always provides basic cart link functionality
