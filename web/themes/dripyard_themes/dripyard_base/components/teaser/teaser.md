# Teaser

A component for displaying article teasers with optional image, title, content, and meta information. The teaser creates a structured layout with flex positioning and consistent spacing.

## Usage

```twig
{{ include('dripyard_base:teaser', {
  attributes,
  title,
  href,
}, with_context = false) }}
```

## Accessibility Considerations

- Uses semantic `<article>` element for proper content structure
- Title uses heading level 3 (`<h3>`) for appropriate content hierarchy
- Link is properly associated with the title text
- Meta information is semantically structured
- Relies on the image-or-media component for proper image accessibility

## Slots and Props

### Props
- `title` (required) - The teaser title text
- `href` (required) - The link URL for the teaser

### Slots
- `teaser_content` (required) - Main content area
- `meta` (optional) - Meta information area (author, date, etc.)
