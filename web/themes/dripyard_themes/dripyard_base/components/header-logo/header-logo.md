# Header Logo Component

A site branding component that renders a logo image wrapped in a homepage link, designed for landscape-oriented logos with consistent alignment.

## Usage

```twig
{{ include('neonbyte:header-logo', {
  site_logo,
}, with_context = false) }}
```

### Props

| Property | Type | Description |
|----------|------|-------------|
| `site_logo` | string | Path to the logo image file |

## CSS Custom Properties

- `--header-logo-max-height` - Maximum height for logo image (default: 44px)

## Logo Configuration

Upload your site logo through the Dripyard Base theme settings:

1. Navigate to **Appearance** in Drupal admin
2. Click **Settings** next to the Dripyard Base theme
3. Upload logo using the **Logo image** field

SVG format is recommended for optimal clarity and scalability.

## Accessibility Features

- **Semantic markup**: Uses proper link structure with `rel="home"`
- **Alt text**: Provides "Home" alt text for screen readers
- **High priority loading**: Uses `fetchpriority="high"` for above-the-fold content
- **Keyboard navigation**: Standard link focus behavior
