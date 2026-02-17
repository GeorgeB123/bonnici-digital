# Tab

The tab component is designed to work within the `tab-group` component. It creates individual tab items with optional icons and associated tab panel content using Shoelace web components (`sl-tab` and `sl-tab-panel`). All styling and JavaScript functionality is provided by the parent tab-group component.

## Usage

```twig
{% embed 'dripyard_base:tab' with {
  title: 'Tab Label',
  icon: 'optional-icon-name'
} only %}
  {% block tab_panel_content %}
    <p>Content for this tab panel...</p>
  {% endblock %}
{% endembed %}
```

## CSS Custom Properties

The tab component inherits all CSS custom properties from its parent `tab-group` component:

- `--tab-inactive-text-color` - Text color when tab is not active
- `--tab-inactive-icon-color` - Icon color when tab is not active
- `--tab-active-text-color` - Text color when tab is active
- `--tab-active-icon-color` - Icon color when tab is active
- `--tab-font-size` - Font size for tab text
- `--tab-font-weight` - Font weight for tab text
- `--tab-padding-block` - Block padding for tab
- `--tab-padding-inline` - Inline padding for tab

## Accessibility Considerations

- Tab navigation and accessibility features are handled by the parent `tab-group` component
- Each tab automatically receives proper ARIA attributes
- Tab panels are properly associated with their corresponding tabs
- Keyboard navigation is fully supported through the tab-group

## Media/Container Queries

- Responsive behavior is managed by the parent `tab-group` component
- Icon sizing and positioning adapts based on tab-group configuration

## Slots and Props

### Props
| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `title` | string | Yes | Tab label text |
| `icon` | string | No | Optional icon name to display with the tab |

### Slots
| Slot | Description |
|------|-------------|
| `tab_panel_content` | Required content for the associated tab panel |
