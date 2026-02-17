# Pill Component

A simple pill or chip component for displaying tags, labels, or short text content with optional linking functionality.

## Usage

```twig
{{ include('dripyard_base:pill', {
  content: tag_content
}, with_context = false) }}
```

### Slots

| Slot | Description |
|------|-------------|
| `content` | Tag content - can be text or link elements |

## CSS Custom Properties

- `--pill-padding-block` - Vertical padding (default: 4px)
- `--pill-padding-inline` - Horizontal padding (default: 16px)
- `--pill-background-color` - Background color for the pill
- `--pill-background-color-hover` - Background color on hover (for linked pills)
- `--pill-text-color` - Text color for the pill
- `--pill-text-color-hover` - Text color on hover (for linked pills)
- `--pill-border-radius` - Border radius for rounded corners

## Content Types

### Text Pills
Simple text content displayed within the pill styling:
- Static labels or tags
- Non-interactive content
- Category indicators

### Linked Pills
Interactive pills containing anchor elements:
- Hover state transitions
- Focus management
- Clickable tag functionality

## Visual Design

- **Compact padding**: Minimal vertical padding (4px) with comfortable horizontal spacing (16px)
- **Rounded corners**: Large border radius for pill-like appearance
- **Flexbox centering**: Content centered both horizontally and vertically
- **Typography**: Uses theme's medium body font styling

## Interactive States

- **Hover effects**: Background and text color transitions for linked pills
- **Focus indicators**: Custom focus ring with 3px offset
- **Smooth transitions**: 0.2s transitions for background and text color changes

## Layout Behavior

- **Inline display**: Pills display inline with other content
- **Auto spacing**: Automatic margin applied when multiple pills are adjacent
- **Flexible content**: Adapts to content width while maintaining consistent height

## Accessibility Features

- **Focus management**: Proper focus handling for linked content
- **Color contrast**: Uses theme colors that meet accessibility standards
- **Keyboard navigation**: Standard link focus behavior for interactive pills
- **Screen reader friendly**: Clean markup structure for assistive technology
