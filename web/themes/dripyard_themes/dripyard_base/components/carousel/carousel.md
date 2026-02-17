# Carousel Component

A responsive carousel component for displaying content with smooth transitions and accessibility features. Built with [Swiper.js](https://swiperjs.com/) for enhanced interactivity and navigation.

## Usage

```twig
{% embed 'dripyard_base:carousel' with {
  label: 'Customer Testimonials',
  pager: true,
  navigation_position: 'inside',
  slides_per_view: 1,
  rows: 1,
} only %}
  {% block carousel_items %}
    {{ include('dripyard_base:testimonial', {
      quote: 'I have made lifelong friendships that I would have never imagined before coming to Great Lake Institute.',
      citation: 'Sophie, 19',
      image: {
        src: 'images/student1.jpg',
        alt: 'Student portrait',
        width: 300,
        height: 300
      }
    }, with_context = false) }}
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `canvas_edit_mode` | boolean | No | Enable to make it easier to place and edit subcomponents from within the Canvas editor |
| `label` | string | Yes | Screen reader label for the carousel (required) |
| `navigation_position` | string | Yes | Navigation button position: `hidden`, `inside`, or `outside` (required) |
| `pager` | boolean | No | Show pagination dots (default: false) |
| `slides_per_view` | number | No | Maximum slides per view (1-6, default: 1). Actual slides shown depends on carousel width |
| `rows` | number | No | Number of rows per view (1-3, default: 1) |
| `autoplay` | boolean | No | Enable automatic slide progression with 5-second intervals (default: false) |

### Slots

| Slot | Description |
|------|-------------|
| `carousel_items` | Container for carousel slide content |

## Theme Integration

- **Theme variants**: Supports all theme color schemes for consistent styling
- **Color customization**: Each theme applies appropriate color variables

## Navigation Positioning

The `navigation_position` prop controls where navigation buttons appear:

- **`hidden`**: No navigation buttons displayed
- **`inside`**: Buttons positioned inside the carousel container
  - Previous button: Left side with small spacing
  - Next button: Right side (adjusts based on container width)
- **`outside`**: Buttons positioned outside the carousel container
  - Previous button: Left of carousel (switches to inside on screens < 1200px)
  - Next button: Right of carousel (switches to inside on screens < 1200px)

## Autoplay Feature

The `autoplay` prop enables automatic slide progression with the following behavior:

- **Default state**: Disabled (false)
- **Interval**: 5-second delay between slides (hard-coded)
- **Reduced motion**: Automatically disabled for users with `prefers-reduced-motion` preference
- **Play/pause control**: Toggle button provided when autoplay is enabled
  - Positioned at bottom of carousel by default
  - Moves to before the pager when both autoplay and pager are enabled
  - Uses `aria-pressed` attribute for accessibility
- **User interaction**: Continues playing after user interactions (does not disable on interaction)

## CSS Custom Properties

### Layout Properties
- `--carousel-gap` - Spacing between carousel items (defaults to `var(--gap)`)
- `--carousel-border-radius` - Corner rounding for carousel elements (default: `0`)
- `--carousel-pagination-offset-vertical` - Vertical offset for pagination controls (default: `20px`)
- `--carousel-background-color` - Background color of carousel container (defaults to `var(--theme-surface)`)

### Pagination Styling
- `--carousel-pager-color` - Default pagination bullet color (defaults to `var(--theme-border-color)`)
- `--carousel-pager-color-active` - Active pagination bullet color (defaults to `var(--theme-text-color-primary)`)
- `--carousel-pager-size` - Size of pagination bullet dots (default: `8px`)

## Swiper.js Integration

The carousel uses Swiper.js with the following configuration:

- **Direction**: Horizontal sliding
- **Speed**: 300ms (1ms for users with reduced motion preference)
- **Space Between**: Automatically calculated from CSS gap property (fallback: 20px)
- **Loop**: Disabled by default
- **Slides Per View**: Responsive based on container width:
  - > 1400px: Uses `slides_per_view` prop value
  - > 1200px: Maximum 4 slides
  - > 800px: Maximum 3 slides
  - > 650px: Maximum 2 slides
  - ≤ 650px: 1.075 slides (showing partial next slide)
- **Rows**: Configurable via `rows` prop (1-3)
- **Grid Fill**: Row-based filling when multiple rows are used
- **Pagination**: Custom bullet renderer with screen reader labels
- **Navigation**: Previous/next buttons with accessible labels
- **A11y**: Built-in accessibility features enabled
- **Canvas Editor**: Automatically disabled when in Canvas edit mode
- **Autoplay**: Optional 5-second interval automatic progression (disabled by default)

### Dynamic Slide Wrapper

The component automatically wraps each carousel item in a `swiper-slide` div during initialization to maintain compatibility with Swiper.js requirements while allowing flexible content structure.

### FOUC (Flash of Unstyled Content) Prevention

The carousel includes CSS rules to prevent flash of unstyled content before Swiper.js loads:

- Hides slides beyond the configured `slides_per_view` count until Swiper initializes
- Applies proper gap spacing to the wrapper before Swiper takes over
- Uses CSS `attr()` function (Chromium only) to calculate slide widths based on `data-slides-per-view`
- Excludes Canvas editor environment from FOUC prevention to maintain editing functionality

## Accessibility Features

This carousel follows accessibility best practices with comprehensive ARIA support:

- **ARIA roles**: Carousel container has `role="group"` with proper labeling
- **Screen reader support**: Hidden labels for all interactive elements
- **Reduced motion support**: Respects `prefers-reduced-motion` media query (uses 1ms transition, disables autoplay)
- **Keyboard navigation**: Full keyboard accessibility
- **Focus management**: Scroll-on-focus enabled for keyboard users
- **Semantic markup**: Proper carousel structure with ARIA attributes
- **No-script support**: Navigation and pagination hidden when scripting disabled

### ARIA Implementation
- Carousel container: `role="group"`, `aria-labelledby`, `aria-roledescription="Carousel"`
- Hidden heading: Links carousel to accessible label via `aria-labelledby`
- Navigation buttons: Visually hidden "Previous" and "Next" labels
- Pagination container: `role="group"` with `aria-label="Choose slide to display"`
- Pagination bullets: Custom renderer with "Slide X" screen reader text
- Slides: `role="group"` with `aria-roledescription="Slide"`
- Slide labels: Dynamic "{{index}} of {{slidesLength}}" messages for context

### Accessibility Cleanup
The component automatically removes unnecessary `aria-live` attributes and redundant `aria-label` attributes from navigation elements to prevent screen reader conflicts.

## Related Components

- **Testimonial**: Individual testimonial slides within the carousel
- **Image or Media Component**: Handles testimonial portrait images
