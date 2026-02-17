# Background Image Component

A utility component that generates a background image for the parent dynamic layout section. This component provides a way to add visual backgrounds while maintaining proper text accessibility and layout flexibility.

### Props

| Property | Type | Required | Default | Description |
|----------|------|----------|---------|-------------|
| `image` | object | **Yes** | - | Image object with src, alt, width, height properties |
| `background_image_opacity` | integer | No | 100 | Background image opacity as a percentage (1-100) |
| `loading` | string | No | lazy | Image loading behavior - use "lazy" unless image is above the fold |
| `position_x` | integer | No | 50 | Horizontal focal point percentage (1-100) for image cropping |
| `position_y` | integer | No | 50 | Vertical focal point percentage (1-100) for image cropping |


## Important Notes

### Component Ordering
- **Should be placed first**: The background image component should be the first component in the list within any dynamic layout cell
- **Editor limitations**: If not placed first, you may not be able to edit other components within the same cell in the Drupal Canvas editor
- **Reordering**: Use the layers tab in the Drupal Canvas sidebar to adjust component order if needed

### Layout Integration
- **Cell positioning**: Can be placed in any cell within the dynamic layout component
- **Full coverage**: Background image covers the entire parent section area
- **Content layering**: Other components and content appear above the background image

## Accessibility Considerations

### Text Contrast
- **4.5:1 ratio required**: Ensure text maintains a minimum 4.5:1 contrast ratio against the background image
- **Theme adjustments**: Modify text color through the dynamic layout's theme settings
- **Image opacity**: Adjust background image opacity to improve text legibility when needed

## Image Loading and Performance

### Loading Options
- **Lazy loading (default)**: Images load when they come into view, improving initial page performance
- **Eager loading**: Images load immediately with the page - only use for above-the-fold images

### Focal Point Control
- **Horizontal position**: Use `position_x` to control which part of the image remains visible when cropped horizontally
- **Vertical position**: Use `position_y` to control which part of the image remains visible when cropped vertically

## Responsive Behavior

- **Adaptive scaling**: Background images automatically scale to fit their container
- **Mobile optimization**: Images should be optimized for different screen sizes
- **Performance**: Consider using responsive image techniques for optimal loading
- **Focal point preservation**: Image focal points ensure important content remains visible across all screen sizes

## Related Components

- **Dynamic Layout**: Primary container component
