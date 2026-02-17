# Social Media Navigation

Standard icon-based social media navigation component that integrates with Drupal's new Icon API.

With Dripyard's recipes, a "Social media links" block is created. You can modify the content of that block within the theme settings at `/admin/appearance/settings/neonbyte`.

## Usage

```twig
{{ include('dripyard_base:social-media-nav', {
  size: 'medium',
  align_x: 'start',
  items: [
    {
      title: 'Facebook',
      icon: 'facebook',
      url: 'https://www.facebook.com',
    },
    {
      title: 'Instagram',
      icon: 'instagram',
      url: 'https://www.instagram.com',
    }
  ]
}, with_context = false) }}
```

## CSS Custom Properties

- `--gap` - Spacing between social media icons (calculated as icon_size * 0.75)
- `--spacing-s` - Vertical margin around the component

## Accessibility Considerations

- Component uses semantic `<nav>` element with proper ARIA labeling
- Each social media link includes a visually hidden title for screen readers
- Links open in new tab/window using `target="_blank"`
- Proper heading structure with hidden h2 element for navigation landmark
- Icons are properly sized and have sufficient spacing for touch targets

## Media/Container Queries

No specific media or container queries defined. Component uses flexbox for responsive layout that adapts to available space.

## Slots and Props

### Props

  - `align_x` (string) - Horizontal alignment: 'start', 'center', or 'end' (default: 'start')
  - `size` (string) - Icon size: 'small' (16px), 'medium' (32px), or 'large' (48px) (default: 'medium')
  - `items` (array) - Array of social media items, each containing:
  - `icon` (string, required) - FontAwesome icon name from supported list
  - `title` (string, required) - Accessible name for the social media platform
  - `url` (string, required) - URL to the social media profile/page

### Slots

No named slots available - content is generated from the items array.
