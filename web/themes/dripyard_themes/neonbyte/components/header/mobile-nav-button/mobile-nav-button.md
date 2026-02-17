# Mobile Nav Button Component

A hamburger menu button component that toggles mobile navigation visibility. Features animated transformation between hamburger and close (X) icons.

## Usage

```twig
{{ include('neonbyte:mobile-nav-button', with_context = false) }}
```

This component requires no props and is typically included directly in the header template.

## CSS Custom Properties

- `--mobile-nav-button-line-color` - Color for hamburger menu lines

## Responsive Behavior

The button adapts to screen width at **1000px** breakpoint:

- **Mobile (≤1000px)**: Visible and functional
- **Desktop (>1000px)**: Hidden via `display: none`

## Animation States

The component transforms between two visual states:

- **Collapsed**: Three horizontal lines (hamburger icon)
- **Expanded**: Two diagonal lines forming an X (close icon)
- **Smooth transitions**: 0.2s animation between states

## Accessibility Features

- **Screen reader text**: "Menu" label for assistive technology
- **ARIA states**: Works with `aria-expanded` attribute set by JavaScript
- **Keyboard support**: Standard button focus and activation
- **High z-index**: Ensures button stays above expanded mobile menu

## Integration

- **Data selector**: Uses `data-drupal-selector="mobile-nav-button"` for JavaScript targeting
- **State management**: Visual state controlled by `aria-expanded` attribute on button
- **Header coordination**: Designed to work within the header component system
