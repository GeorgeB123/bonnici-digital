# Header Component

A fixed-position site header with responsive navigation, frosted glass visual effects, and integrated sub-components for branding, menus, and utilities.

## Usage

The component is invoked directly through the theme's `page.html.twig`.

```twig
{% embed 'neonbyte:header' with {
    theme: 'light',
    header: page.header,
    header_first: page.header_first,
    header_second: page.header_second,
    header_third: page.header_third,
  } only %}
    {% block header_third %}
      {{ header_third }}
    {% endblock %}
  {% endembed %}
```

### Slots

| Slot | Description |
|------|-------------|
| `header_first` | Site branding and logo area |
| `header_second` | Primary navigation menu |
| `header_third` | Utility elements (search, language switcher, CTA) |

## CSS Files

The header component uses two CSS files:

- **`header.css`** - Core layout, positioning, and responsive behavior
- **`header.theme.css`** - Theme-specific visual styling and color variables

## CSS Custom Properties

### Theme Variables (header.theme.css)

- `--header-text-color` - Header text color
- `--header-box-shadow` - Drop shadow effect with color mixing
- `--header-background-color-percent` - Background transparency percentage
- `--header-background-color` - Semi-transparent background with color mixing
- `--header-margin-top` - Top margin for header content
- `--header-padding-block` - Vertical padding for header content
- `--header-padding-inline` - Horizontal padding for header content
- `--header-border-radius` - Border radius for header container

## Responsive Behavior

The header switches between desktop and mobile modes at **1000px**:

- **Mobile**: Vertical navigation with hamburger menu
- **Desktop**: Horizontal layout with hover interactions
- **Breakpoint changes**: Search for `1000px` in header directory to modify

## No JavaScript behavior

If JavaScript is not available (slow connection, something breaks, etc) we use `@media (scripting: none)` to make the site usable. This includes at mobile breakpoints, where the navigation will appear in an open state at the top of the site.

## Sub-Components

The header integrates multiple SDC components:

- `header-logo` - Site branding and logo
- `header-search` - Search functionality
- `language-switcher` - Language selection
- `mobile-nav-button` - Mobile navigation toggle
- `primary-menu` - Main navigation menu
- `secondary-menu` - Secondary navigation

## JavaScript Features

Drupal behaviors provide:

- Responsive detection and mode switching
- Dynamic dropdown height calculations
- Focus trap support for mobile navigation
- Theme toggling based on screen size

Custom dropdowns must use `.site-header__dropdown` and `.site-header__dropdown--active` classes for proper behavior integration.

## Accessibility Features

- **Focus management**: Proper focus management at both narrow and wide viewports
- **Semantic markup**: Proper HTML structure for screen readers
- **Keyboard support**: Full keyboard navigation compatibility
- **Progressive enhancement**: Graceful degradation when JavaScript is disabled

## Drupal Integration

Three header regions are defined for block placement:

| Region | Purpose |
|--------|---------|
| `header_first` | Site branding and logo |
| `header_second` | Primary navigation |
| `header_third` | Utility elements and secondary actions |

## Visual Effects

- **Fixed positioning**: Header stays at top during scroll
- **Frosted glass**: Semi-transparent background with backdrop filter
- **Dynamic shadows**: Responsive visual styling
- **Container integration**: Respects Drupal's displacement system
