# Horizontal Line Component

A styled horizontal rule component that provides visual separation between content sections with customizable spacing, color, and width options.

## Usage

### Basic horizontal line

```twig
{{ include('dripyard_base:horizontal-line', {
  margin_top: 'medium',
  margin_bottom: 'medium',
  color: 'soft',
  width: 'full',
  alignment: 'center'
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `margin_top` | string | Yes | Top margin spacing: `zero`, `small`, `medium`, `large` |
| `margin_bottom` | string | Yes | Bottom margin spacing: `zero`, `small`, `medium`, `large` |
| `color` | string | Yes | Line color: `soft`, `medium`, `loud`, `primary` |
| `width` | string | Yes | Line width: `small` (40px), `medium` (100px), `full` (100%) |
| `alignment` | string | Yes | Horizontal alignment: `start`, `center`, `end` |
| `modifier_classes` | string | No | Additional CSS classes |

## Margin Options

The component provides four margin sizes for both top and bottom spacing:

- **zero**: No margin (0)
- **small**: Small margin using design system spacing
- **medium**: Medium margin using design system spacing
- **large**: Large margin using design system spacing

## Color Options

The component provides four color variants:

- **soft**: Soft border color (`--theme-border-color-soft`)
- **medium**: Medium border color (`--theme-border-color-medium`)
- **loud**: Loud border color (`--theme-border-color-loud`)
- **primary**: Primary brand color (`--primary`)

## Width Options

The component provides three width variants:

- **small**: Fixed 40px width
- **medium**: Fixed 100px width
- **full**: 100% of container width

## Alignment Options

The component provides three horizontal alignment options:

- **start**: Aligns the line to the start of its container (left in LTR, right in RTL)
- **center**: Centers the line within its container
- **end**: Aligns the line to the end of its container (right in LTR, left in RTL)

## CSS Custom Properties

The component uses design system CSS custom properties:

- `--theme-border-color-soft`: Soft color variant
- `--theme-border-color-medium`: Medium color variant
- `--theme-border-color-loud`: Loud color variant
- `--primary`: Primary color variant

## Styling Architecture

### Display Behavior
- **Semantic HTML**: Uses the `<hr>` element for proper semantic meaning
- **Visual styling**: Removes default browser styling and applies custom appearance
- **Centered alignment**: Lines are centered within their container
- **Responsive**: Maintains proportional width across different screen sizes
