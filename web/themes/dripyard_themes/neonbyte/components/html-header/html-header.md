# HTML Header Component

A utility component for inserting custom HTML elements into the document `<head>` section. This component contains no styles or JavaScript and is designed to be overridden per theme using the `replaces` key within Single Directory Components definition.

## Usage

This component is automatically invoked from the `dripyard_base` theme's `html.html.twig` template and should be overridden in child themes to include theme-specific head elements.

```twig
{% set font_path = '/' ~ directory ~ '/fonts/instrument-sans/' %}

<link rel="preload" href="{{ font_path ~ 'instrument-sans-v1-latin-600.woff2' }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ font_path ~ 'instrument-sans-v1-latin-regular.woff2' }}" as="font" type="font/woff2" crossorigin>
```

## Common Use Cases

### Font Preloading
Preload critical fonts that appear "above the fold" on page load:

```twig
{% set font_path = '/' ~ directory ~ '/fonts/font-family/' %}
<link rel="preload" href="{{ font_path ~ 'font-file.woff2' }}" as="font" type="font/woff2" crossorigin>
```

### Hard code Meta Tags
Add theme-specific meta tags:

```twig
<meta name="theme-color" content="#primary-color">
<meta name="msapplication-TileColor" content="#primary-color">
```

### Favicon Links
Include theme-specific favicon files:

```twig
<link rel="icon" type="image/png" sizes="32x32" href="{{ directory }}/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="{{ directory }}/favicon-16x16.png">
```

## Best Practices

- **Performance**: Only preload fonts that appear "above the fold" on page load
- **Maintenance**: Update font preloads when changing theme fonts
