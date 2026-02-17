# Menu Footer Component

A hierarchical menu component designed for footer navigation with intelligent layout behavior and multi-level support.

## Usage

```twig
{% include 'dripyard_base:menu-footer' with {
  items: menu_tree
} %}
```

## Layout Behavior

- **Mobile**: Vertical column layout with 8px gaps
- **Desktop**: Horizontal flex layout with wrapping for flat menus
- **Multi-level**: Grid layout when parent items have children
- **Level 3+**: Indented with left border for hierarchy

## Menu Structure

- **Level 1**: Top-level items with optional nolink headings
- **Level 2**: Child items under headings
- **Level 3+**: Further nested items with visual indentation
- **Nolink items**: Rendered as headings for section organization

## Accessibility Features

- **Semantic HTML**: Uses proper list structure (`<ul>`, `<li>`)
- **Link types**: Handles standard links, nolinks, and button items
- **Active states**: Supports active trail highlighting
- **Keyboard navigation**: Standard link focus behavior
- **Proper semantics**: Ensure menu items are not `<button>` or `<nolink>` (`<span>`) elements
