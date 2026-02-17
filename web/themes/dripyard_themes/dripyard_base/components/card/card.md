# Card Component

A standard card component for displaying content with optional image, eyebrow text, title, and body. Designed to be placed within layout components and grouped with other cards.

There's  two components in this component's directory. The `card` component is meant for regular Drupal, while the `card-canvas` is meant for Drupal Canvas. The main difference is that the `card-canvas` has a `$ref` value that points to a Drupal Canvas schema definition. This component cannot be loaded if Canvas is not present ([Drupal.org issue](https://www.drupal.org/project/canvas/issues/3552121)), as there will be a 500 error. The two components share the same Twig file and CSS file. The regular `card` component is excluded from appearing in page builder user interfaces with the `noUi: false` key value within the schema.

## Video

YouTube: https://youtu.be/0-XSsaOjnqA

## Usage

```twig
{{ include('dripyard_base:card', {
  image: {
    src: 'images/example.jpg',
    alt: 'Card image',
    width: 325,
  },
  eyebrow_text: 'Category',
  title: 'Card Title',
  body: 'Card description text here.',
  href: '/learn-more'
}, with_context = false) }}
```

### Usage with a view mode

```twig
{% embed 'dripyard_base:card' with {
  image: content.field_image,
  eyebrow_text: 'Category',
  title: 'Card Title',
  href: '/learn-more'
} only %}
  {% block card_body %}
    <p class="custom-content">
      <p>Custom body content with additional markup.</p>
      <ul>
        <li>List item 1</li>
        <li>List item 2</li>
      </ul>
    </p>
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `title` | string | Yes | Card heading text |
| `href` | string | No | Link destination URL - makes the entire card clickable |
| `image` | object | No | Image object with src, alt, width, height |
| `eyebrow_text` | string | No | Pre-title text displayed above the title |
| `body` | string | No | Card body content text |
| `theme` | string | No | Theme variant: inherit, white, light, dark, black, primary (default: inherit) |
| `flip_layout` | boolean | No | Flips the layout in horizontal mode (image on right, content on left) |

### Slots

| Slot | Description |
|------|-------------|
| `card_body` | Custom body content area that replaces the default body text. Allows for rich markup and custom styling. Note this is intentionally not defined in the schema, so fields can be selected within the Drupal Canvas UI. |

## CSS Custom Properties

- `--card-border-radius` - Corner rounding for card elements
- `--card-background` - Background color for card content area
- `--card-text-color` - Default text color
- `--card-heading-color` - Title text color
- `--card-body-color` - Body text color
- `--card-bottom-gap` - Spacing between card content elements

## Container Queries

The component uses container queries for responsive layout. At wide layouts the card shifts to a horizontal layout.

```css
@container (width > 600px) {
  .card__layout {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}
```

### Text Clamping
For medium-width containers in horizontal mode (600px-800px), body text is limited to 3 lines:

```css
@container (600px < width < 800px) {
  .card__body {
    -webkit-line-clamp: 3;
  }
}
```

## Layout Behavior

- **Narrow containers**: Vertical stacked layout (image above content)
- **Wide containers**: Two-column grid layout (image beside content)
- **Flipped layout**: When `flip_layout` is true, horizontal layout shows image on right, content on left
- **Icon positioning**: Eyebrow icon moves to top-right corner in wide layout

## Accessibility Features

- **Semantic article**: Uses `<article>` element for proper content sectioning
- **Accessible links**: Full card clickable area with proper link semantics
- **Image handling**: Requires alt text for accessibility
- **RTL support**: Icon automatically flips for right-to-left languages

## Interactive Elements

### Card Link
- **Full card clickable**: Pseudo-element covers entire card area
- **Focus management**: Proper focus indicators for keyboard navigation
- **Hover effects**: Icon background color changes on hover

### Image Display
- **Aspect ratio**: Fixed 4:3 aspect ratio with object-fit cover
- **Responsive**: Full width within container

## Content Structure

### Eyebrow Section
- **Text and icon**: Displays eyebrow text with arrow icon
- **Flexible layout**: Space-between alignment
- **Conditional display**: Only renders when eyebrow text is provided

### Title Section
- **Linked heading**: H3 element wrapped in card link
- **Typography**: Uses H4 design system styles

### Body Content
- **Rich content**: Strips HTML tags from body field except for `strong`, `p`, `br`, and `em`.
- **Margin normalization**: First/last child margins removed
- **Typography inheritance**: Maintains consistent text styling
