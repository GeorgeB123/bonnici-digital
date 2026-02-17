# Testimonial Component

Individual testimonial component designed to work within the testimonial carousel or as a standalone element. Features responsive image positioning, quote display, and citation attribution with flexible layout options.

There's  two components in this component's directory. The `testimonial` component is meant for regular Drupal, while the `testimonial-canvas` is meant for Drupal Canvas. The main difference is that the `testimonial-canvas` has a `$ref` value that points to a Drupal Canvas schema definition. This component cannot be loaded if Canvas is not present ([Drupal.org issue](https://www.drupal.org/project/canvas/issues/3552121)), as there will be a 500 error. The two components share the same Twig file and CSS file. The regular `testimonial` component is excluded from appearing in page builder user interfaces with the `noUi: false` key value within the schema.

## Usage

```twig
{{ include('mytheme:testimonial', {
  quote: 'I have made lifelong friendships that I would have never imagined before coming to Great Lake Institute. The university and the people here have helped shape me into the person I am now.',
  citation: 'Sophie, 19',
  image: {
    src: 'images/student1.jpg',
    alt: 'Portrait of Sophie',
    width: 300,
    height: 300
  },
  reversed: false
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `quote` | string | Yes | The testimonial quote text |
| `citation` | string | No | Attribution text (name, title, etc.) |
| `image` | object | Yes | Image object with src, alt, width, height properties |
| `reversed` | boolean | No | Reverses the layout order for visual variety |

## Responsive Layout

### Mobile Layout
- **Image positioning**: Image displayed in first container above quote
- **Stacked layout**: Vertical arrangement of image, quote, and citation
- **Second image hidden**: Desktop image container is hidden on mobile

### Desktop Layout
- **Image positioning**: Image displayed in second container beside quote
- **Side-by-side layout**: Horizontal arrangement with image alongside content
- **First image hidden**: Mobile image container is hidden on desktop
- **Reversed layout**: When `reversed` prop is true, content order is swapped for visual variety

## CSS Custom Properties

### Layout Properties
- `--testimonial-min-height` - Minimum height for testimonial items (670px)
- `--testimonial-padding-block` - Vertical padding inside testimonial content (40px)
- `--testimonial-padding-inline` - Horizontal padding inside testimonial content (32px mobile, 64px desktop)
- `--testimonial-border-radius` - Corner rounding for testimonial containers (inherits from carousel, fallback 24px)
- `--testimonial-gap` - Spacing between testimonial elements (inherits from theme gap, fallback 20px)

### Typography
- `--testimonial-font-size` - Quote text size (h4 size mobile, h3 size desktop)

### Color Properties
- `--testimonial-background-color` - Background color for testimonial content area
- `--testimonial-quote-text-color` - Color for quote text
- `--testimonial-cite-text-color` - Color for citation text

## Responsive Behavior
- **Container queries**: Layout adapts based on available container width
- **Mobile-first**: Default single-column layout for narrow containers
- **Desktop enhancement**: Two-column layout for containers > 800px width
- **Image handling**: Different image containers for mobile vs desktop display

## Related Components

- **Testimonial Carousel**: Parent carousel component that displays multiple testimonials
- **Image or Media Component**: Handles image rendering and optimization
