# Footer Component

The main site footer component for the Dripyard Base theme with four content regions and configurable theme options.

## Usage

```twig
{% embed 'dripyard_base:footer' with {
  theme: 'dark'
} %}
  {% block footer_top_content %}
    {# Top footer content #}
  {% endblock %}
  {% block footer_left_content %}
    {# Left footer content #}
  {% endblock %}
  {% block footer_right_content %}
    {# Right footer content #}
  {% endblock %}
  {% block footer_bottom_content %}
    {# Bottom footer content #}
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Options | Description |
|----------|------|---------|-------------|
| `theme` | string | `inherit`, `white`, `light`, `dark`, `black`, `primary` | Sets background and text colors |

### Slots

| Slot | Description |
|------|-------------|
| `footer_top_content` | Full-width content area spanning entire footer width |
| `footer_left_content` | Left content area in two-column layout |
| `footer_right_content` | Right content area in two-column layout |
| `footer_bottom_content` | Full-width bottom content area |

## CSS Custom Properties

- `--footer-surface` - Background color for the footer
- `--footer-text-color-soft` - Soft text color for secondary content
- `--footer-text-color-medium` - Medium text color for main content
- `--footer-link-color` - Color for footer links
- `--footer-border-color` - Border color for footer elements

## Container Queries

The footer uses container queries for responsive layout:

## Layout Behavior

- **Mobile**: All content areas stack vertically and span full width
- **Desktop**: Left and right content areas form a two-column layout

## Theme Integration

The footer integrates with Neonbyte's theme system:

- **Page template**: Invoked directly via `page.html.twig`
- **Drupal regions**: Each slot maps to a Drupal region (defined in `neonbyte.info.yml`)
- **Theme settings**: Theme can be configured via UI at `/admin/appearance/settings/neonbyte`

## Accessibility Features

- **Semantic footer**: Uses proper `<footer>` element
- **Link styling**: Enhanced link appearance with underline offset and transitions
- **Color contrast**: Theme system ensures proper contrast ratios

## Related Components

- **Menu Footer**: Specialized menu component for footer navigation
