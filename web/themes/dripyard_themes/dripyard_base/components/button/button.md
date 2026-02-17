# Button Component

A flexible button component with multiple style variants, sizes, and icon support for creating interactive links and actions.

Note that if the `href` prop is passed, this component will render a `<a>` tag. Otherwise, it will render a `<button>` element.

## Usage

```twig
{{ include('dripyard_base:button', {
  text: 'Learn More',
  href: '/learn-more',
  style: 'primary',
  size: 'medium',
  prefix_icon: 'arrow-right',
  target: true
}, with_context = false) }}
```

### Props

| Property | Type | Options | Required | Description |
|----------|------|---------|----------|-------------|
| `text` | string | - | Yes | Button text content |
| `href` | string | - | No | Link destination URL. If omitted, will render `<button>` element. |
| `style` | string | `default`, `primary`, `secondary`, `outline`, `bare`, `danger`, `light`, `dark` | No | Button color variant |
| `size` | string | `xs`, `small`, `medium`, `large` | No | Button size variant |
| `target` | boolean | `true`, `false` | No | Open link in new window |
| `prefix_icon` | string | - | No | Icon displayed before text |
| `suffix_icon` | string | - | No | Icon displayed after text |

## Style Variants

- **Default**: Theme-based styling for secondary actions using theme button colors
- **Primary**: Primary brand color with strong visual emphasis for main call-to-action buttons
- **Secondary**: Secondary brand color with strong visual emphasis
- **Outline**: Transparent background with border outline using theme link colors
- **Bare**: Minimal styling with no background or border, uses theme link colors
- **Danger**: Red error/destructive action styling for delete or warning actions
- **Light**: Light variant with light background and dark text for contrast on dark backgrounds
- **Dark**: Dark variant with dark background and light text for contrast on light backgrounds

## Size Variants

- **XS**: Extra small button (25px height, 12px font, 400 weight)
- **Small**: Compact button (35px height, 12px font, 400 weight)
- **Medium**: Default size (48px height, 16px font, 600 weight)
- **Large**: Prominent button (56px height, 20px font, 600 weight)

## CSS Custom Properties

### Base Button Variables
- `--button-border-radius` - Corner rounding (uses `var(--radius-button)`)
- `--button-border-width` - Border thickness (1px)
- `--button-icon-background-radius` - Icon container border radius (50%)
- `--button-font-family` - Font family (inherit)
- `--button-font-size` - Text size (uses `var(--body-m-size)`)
- `--button-font-weight` - Text weight (600)
- `--button-height` - Button height (48px)
- `--button-padding-block` - Vertical padding (10px)
- `--button-padding-inline` - Horizontal padding (20px)

### Default Variant Variables (Theme-based)
- `--theme-button-text-color` / `*-hover` / `*-active` - Text colors for all states
- `--theme-button-border-color` / `*-hover` / `*-active` - Border colors for all states
- `--theme-button-background-color` / `*-hover` / `*-active` - Background colors for all states
- `--theme-button-icon-background-color` / `*-hover` / `*-active` - Icon background colors
- `--theme-button-icon-fill` / `*-hover` / `*-active` - Icon fill colors

### Primary Variant Variables
- `--button-background-color` - Uses `var(--primary)`
- `--button-background-color-hover` - Uses `var(--color-primary-surface-alt)`
- `--button-background-color-active` - Uses `var(--color-primary-surface-alt-2)`
- `--button-text-color` - Uses `var(--color-primary-text-color)`
- `--button-icon-fill` - Uses `var(--color-primary-text-color)`
- `--button-icon-background-color` - Uses `var(--color-primary-surface-alt-2)`
- `--button-border-color` - Uses `var(--color-primary-surface-alt)`

### Secondary Variant Variables
- `--button-background-color` - Uses `var(--secondary)`
- `--button-background-color-hover` - Uses `var(--color-secondary-surface-alt)`
- `--button-background-color-active` - Uses `var(--color-secondary-surface-alt-2)`
- `--button-text-color` - Uses `var(--color-secondary-text-color)`
- `--button-icon-fill` - Uses `var(--color-secondary-text-color)`
- `--button-icon-background-color` - Uses `var(--color-secondary-surface-alt-2)`
- `--button-border-color` - Uses `var(--color-secondary-surface-alt)`

### Outline & Bare Variants
- Uses `--theme-link-color` and `--theme-link-color-hover`
- Uses `--theme-border-color-alt` (outline variant only)

### Danger Variant
- Uses `--color-error-dark` for background
- Uses `--white` for text color

### Size-Specific Variable Overrides

**XS Size:**
- `--button-font-size: 12px`
- `--button-font-weight: 400`
- `--button-height: 25px`
- `--button-padding-block: 4px`
- `--button-padding-inline: 12px`

**Small Size:**
- `--button-font-size: 12px`
- `--button-font-weight: 400`
- `--button-height: 35px`
- `--button-padding-block: 10px`
- `--button-padding-inline: var(--sp2)`

**Large Size:**
- `--button-height: 56px`
- `--button-padding-inline: 20px`
- `--button-font-size: 20px`

## Accessibility Features

- **Semantic markup**: Uses `<a>` or `<button>` element.
- **Focus indicators**: Clear focus states with customizable focus ring colors
- **Keyboard navigation**: Standard link keyboard interaction
- **Screen readers**: Proper text content and icon labeling

## Icon Integration

- **Flexible positioning**: Icons can be placed before (prefix) or after (suffix) text
- **Size adaptation**: Icon size automatically adjusts based on button size (16px for small/medium, 24px for large)
- **Visual effects**: Icons translate 2px on hover for interactive feedback
- **Icon containers**: Icons are wrapped in circular containers with background styling

## Interactive States

- **Hover**: Background color change and icon translation
- **Active**: Slight scale increase (1.03) and color changes
- **Disabled**: Reduced opacity and disabled cursor
- **Transitions**: Smooth 0.2s transitions for color changes and 0.1s for scale

## Global Library Integration

The button CSS is a dependency of the theme's global library, ensuring button styles are available site-wide.

## Related Components

- **Icon Component**: Provides icons for prefix and suffix display
