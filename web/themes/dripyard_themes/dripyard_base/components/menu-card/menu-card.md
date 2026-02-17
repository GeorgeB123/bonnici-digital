# Menu Card Component

A promotional card component featuring a background image with overlaid text link, designed for use in navigation dropdowns and menu systems.

## Usage

```twig
{{ include('dripyard_base:menu-block', {
  attributes,
  show_title: false,
  title: label,
  title_prefix,
  title_suffix,
  title_attributes,
  content,
  theme: 'inherit',
}, with_context = false) }}
```

### Props

| Property | Type | Description |
|----------|------|-------------|
| `image` | object | Background image data (Experience Builder or Drupal format) |
| `link` | string | Rendered link element with text content |

## Visual Design

- **Fixed dimensions**: 250px width with 4:3 aspect ratio
- **Image overlay**: Background image with 70% opacity (100% on hover)
- **Text positioning**: Absolute positioned link covers entire card
- **Rounded corners**: Uses theme's medium border radius
- **Smooth transitions**: 0.2s opacity transition on hover

## Image Behavior

- **Full coverage**: Images use `object-fit: cover` to fill container
- **Opacity states**: 70% opacity default, 100% on hover
- **Absolute positioning**: Images positioned to fill entire card area

## Accessibility Features

- **Contrast requirements**: Text must meet 4.5:1 contrast ratio over image
- **Focus indicators**: Custom focus ring with 3px offset
- **Full card clickable**: Entire card area is interactive
- **Semantic markup**: Uses list item structure for menu integration

## Integration

- **Drupal blocks**: Invoked through `dripyard_menu_card` block content type
- **Menu attachment**: Cards can be attached to top-level menu items
- **Dropdown display**: Appears within navigation submenus
- **Recipe installation**: Available through Dripyard's recipe system

## Implementation

Cards are typically created as Drupal blocks and attached to menu items, where they automatically appear in dropdown menus as promotional content alongside standard navigation links.
