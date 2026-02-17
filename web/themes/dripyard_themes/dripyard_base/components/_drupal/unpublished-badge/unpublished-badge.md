# Unpublished Badge Component

A visual indicator that displays when content is in an unpublished state. This component provides a prominent warning badge to alert users that the content is not publicly visible.

## Usage

This component is automatically applied by Drupal to unpublished content and does not require manual implementation. It's marked as `noUi: true` in the component schema, meaning it's not intended for direct use in the UI.

```twig
{{ include('dripyard_base:unpublished-badge', {}, with_context = false) }}
```

### Props

This component takes no props - it displays a static "Unpublished" message.

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| None | - | - | This component has no configurable properties |

## Visual Design

### Badge Appearance
- **Background**: Warning color with rounded top corners
- **Text**: "Unpublished" label in white text with 600 font weight
- **Icon**: Warning icon displayed before the text
- **Border**: Warning-colored bottom border for emphasis

### Spacing
- **Bottom margin**: 20px spacing below the badge
- **Internal padding**: 8px vertical, 8px start, 12px end
- **Icon gap**: 4px space between icon and text

## CSS Custom Properties

The component uses theme color variables for consistent styling:

- `--theme-color-warning` - Background and border color for the warning badge
- `--theme-surface` - Text and icon color (typically white)
- `--radius-sm` - Border radius for rounded corners
- `--body-l-size` - Font size for the badge text
- `--spacing-xs` - Bottom margin spacing (20px)
- `--spacing-xxs` - Vertical padding (8px)

## Icon

The component includes a warning icon using an SVG mask:
- **Source**: `images/warning.svg`
- **Size**: 1.5em × 1.5em
- **Color**: Matches text color using CSS mask technique

## Accessibility Features

- **High contrast**: Warning color background ensures good visibility
- **Semantic meaning**: Clear "Unpublished" text conveys status
- **Icon support**: Visual warning icon reinforces the message
- **Translatable**: Text uses Drupal's translation system (`|t`)

## Integration

### Drupal Integration
- **Automatic display**: Appears automatically on unpublished content
- **Template integration**: Typically included in node and content templates
- **Translation ready**: All text strings use Drupal's translation API

### Theme System
- **Color theming**: Uses theme warning color variables
- **Spacing consistency**: Follows theme spacing system
- **Typography**: Uses theme body text sizing

## Best Practices

### Display Context
- **Editor visibility**: Most useful in editorial and preview contexts
- **Admin interfaces**: Commonly shown in content management screens
- **Preview modes**: Helps distinguish draft from live content

### Styling Considerations
- **Prominent placement**: Position near content title or at top of content
- **Consistent styling**: Maintain warning color consistency across site
- **Responsive design**: Badge scales appropriately on different screen sizes

## Technical Notes

- **No props required**: Component is completely self-contained
- **Static content**: Always displays the same "Unpublished" message
- **CSS Grid/Flexbox**: Uses modern layout techniques for icon alignment
- **Performance**: Lightweight component with minimal DOM footprint