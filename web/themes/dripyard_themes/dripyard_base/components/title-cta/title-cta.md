# Title CTA Component

A component that combines a title with a button component. This is frequently used in `content_above` slots and layout regions within Neonbyte's design system.

## Usage

```twig
{{ include('dripyard_base:title-cta', {
  layout: 'default',
  title: 'We offer powerful solutions for Companies and Governments',
  heading_style: 'h2',
  button_href: 'http://www.example.com',
  button_text: 'All solutions',
  button_style: 'primary',
  button_size: 'large',
  button_suffix_icon: 'arrow-right',
  button_target: false,
}, with_context = false) }}
```

## CSS Custom Properties

- `--title-cta-heading-color`: Controls the color of the heading text (defaults to `var(--theme-text-color-loud)`)
- `--title-cta-heading-width`: Controls the maximum width of the heading text (defaults to `600px`)

## Accessibility Considerations

- Uses semantic heading structure through the included heading component
- Button component provides proper link accessibility features
- Proper color contrast maintained through CSS custom properties

## Media/Container Queries

- Responsive flex layout with `flex-wrap: wrap` for smaller screens
- Large gap between title and button maintains spacing across breakpoints
- Center layout variant stacks elements vertically for better mobile experience

## Props

- **layout** (string): Layout variant - 'default' (spaced apart) or 'center' (centered)
- **title** (string, required): The heading text to display
- **heading_style** (string): Heading style variant (title, h1, h2, h3, h4, h5, h6, body_l, body_m, body_s) - defaults to 'h2'
- **button_text** (string): Button text
- **button_href** (string): Button link URL
- **button_style** (string): Button style variant (default, primary, secondary, light, dark, outline, bare) - defaults to 'primary'
- **button_size** (string): Button size (small, medium, large) - defaults to 'large'
- **button_target** (boolean|null): Whether to open link in new window - defaults to false
- **button_prefix_icon** (string|null): Icon to display before button text
- **button_suffix_icon** (string|null): Icon to display after button text - defaults to 'arrow-right'
