# Hero Component

A full-width hero component with background image, overlaid content, and flexible alignment options. Suitable for homepages and prominent landing pages.

## Usage

```twig
{% embed 'neonbyte:hero' with {
  height: 'full-screen',
  theme: 'dark',
  align_x: 'center',
  align_y: 'center',
  text_color: 'white',
  position_behind_against_screen_top: true,
  content,
} only %}
  {% block hero_media %}
    {{ content.field_hero_image|add_suggestion('bare') }}
  {% endblock %}
  {% block hero_content %}
    {{ include('dripyard_base:heading', {
      text: content.field_title|add_suggestion('bare'),
      html_element: 'h1',
      style: 'title',
      color: 'default',
      center: false,
      margin_top: 'zero',
      margin_bottom: 'zero',
    }, with_context = false) }}
    <p>Your hero body content goes here</p>
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `height` | string | Yes | Hero height: small, medium, large, full-screen |
| `theme` | string | No | Theme variant: inherit, white, light, dark, black, primary (default: inherit) |
| `align_x` | string | No | Horizontal alignment: start, center, end (default: start) |
| `align_y` | string | No | Vertical alignment: top, center, bottom (default: center) |
| `text_color` | string | No | Text color override: inherit, black, white, primary (default: inherit) |
| `position_behind_against_screen_top` | boolean | No | Positions hero against top edge of screen behind navigation. Only works if hero is first component on page |

### Slots

| Slot | Description |
|------|-------------|
| `hero_media` | Image or video background media. Accepts image or video components. For Drupal Canvas, use canvas-image and video-player-canvas components |
| `hero_content` | Hero content area for text, button groups, and other hero elements |

## CSS Custom Properties

- `--hero-background` - Background color overlay
- `--hero-text-color-light` - Light text color for secondary content
- `--hero-text-color` - Primary text color for main content
- `--hero-link-color` - Color for links and interactive elements
- `--hero-text-shadow-color` - The color of the text shadow
- `--hero-text-shadow` - Text shadow for hero text

## Alignment System

### Horizontal Alignment (align_x)
- **start**: Left-aligned content
- **center**: Centered content with center text alignment
- **end**: Right-aligned content with end text alignment

### Vertical Alignment (align_y)
- **top**: Content aligned to top of hero
- **center**: Content vertically centered (default)
- **bottom**: Content aligned to bottom of hero

## Theme Integration

- **Theme variants**: Supports all theme color schemes
- **Text color overrides**: Independent text color control
- **Dark/Light themes**: Automatic text color adjustments
- **Primary color**: Uses theme's primary color variables

## Accessibility Features

- **Contrast requirements**: Text must meet 3:1 contrast ratio at all screen widths
- **Semantic markup**: Uses proper h1 for hero title
- **Image optimization**: High priority loading with `fetchpriority="high"`

## Layout Integration

- **Full-width**: Breaks out of container to span viewport width
- **Full-height**: Prevents automatic component padding
- **Z-index layering**: Content positioned above background image
- **Container system**: Content respects theme's container constraints

## Performance Considerations

- **Eager loading**: Background image loads immediately
- **High fetch priority**: Optimized for above-the-fold content
- **Image sizing**: Supports images up to 3000px width
- **Responsive images**: Integrates with responsive image system
