# Tags

A component for displaying taxonomy tags in a horizontal layout with an optional title.

## Usage

```twig
{{ include('dripyard_base:tags', {
  attributes,
  title,
  items,
}, with_context = false) }}
```

## Accessibility Considerations

- Uses semantic list markup (`<ul>` and `<li>`) for proper screen reader navigation
- Title uses heading level 3 (`<h3>`) for proper content hierarchy
- Relies on the pill component for individual tag accessibility

## Media/Container Queries

- Uses flexbox with `flex-wrap: wrap` for responsive layout
- Tags automatically wrap to new lines as needed
- No specific breakpoint-based styling

## Slots and Props

### Props

- `title` (string, optional): Display title for the tag list
- `items` (array, required): Array of tag items to display
- `attributes` (object, optional): HTML attributes for the container

### Slots

- Each item in the `items` array should contain:
  - `content`: The tag content to display
  - `attributes`: HTML attributes for the individual tag item

The component internally uses the `pill` component for rendering individual tags.
