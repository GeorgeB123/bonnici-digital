# Promo Component

⚠️ This component is marked as obsolete. You can create the same layout using headings, text, flex-wrapper, and buttons.

---

A promotional content component featuring eyebrow text, title, body content, and call-to-action buttons with flexible alignment options.

## Usage

```twig
{% embed 'dripyard_base:promo' with {
  title: 'Promotional Title',
  eyebrow: 'Special Offer',
  body: 'Compelling promotional content',
  theme: 'primary',
  align_x: 'center',
  align_y: 'center'
} only %}
  {% block promo_content %}
    <!-- Call-to-action buttons -->
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `title` | string | Yes | Main promotional title |
| `eyebrow` | string | No | Pre-title text for context |
| `body` | string | No | Promotional body content |
| `theme` | string | No | Theme variant: inherit, white, light, dark, black, primary (default: inherit) |
| `align_x` | string | No | Horizontal alignment: start (default), center, end |
| `align_y` | string | No | Vertical alignment: top (default), center, bottom |

### Slots

| Slot | Description |
|------|-------------|
| `promo_content` | Content area for CTAs and additional promotional elements |

## CSS Custom Properties

- `--promo-surface` - Background color for themed containers
- `--promo-text-color-soft` - Color for eyebrow text
- `--promo-text-color-medium` - Color for main content

## Alignment System

### Horizontal Alignment
- **Start**: Left-aligned content
- **Center**: Center-aligned content
- **End**: Right-aligned content with

### Vertical Alignment
- **Top**: Default positioning (no margin adjustment)
- **Center**: Auto margins for vertical centering
- **Bottom**: Auto top margin for bottom alignment

## Content Hierarchy

- **Eyebrow**: Small, soft-colored pre-title text
- **Title**: H2 element with large typography
- **Body**: Medium body text with paragraph spacing

## Layout Behavior

- **Flexbox column**: Content stacked vertically with consistent gaps
- **Responsive alignment**: Alignment classes work with layout regions
- **Theme backgrounds**: Background color applied only when theme is set

## Integration

- **Slot-based content**: Uses promo_content slot for flexible content placement
- **Theme system**: Supports all theme color variations
- **Layout regions**: Responds to parent layout alignment classes

## Typography

- **Eyebrow**: Small body size with soft color for subtle emphasis
- **Title**: H2 typography scale for prominent display
- **Body**: Medium body size for readable promotional content
- **Consistent spacing**: Proper line height adjustments and gap spacing

## Accessibility Features

- **Semantic markup**: Uses proper heading hierarchy with h2 element
- **Color contrast**: Uses theme colors that meet accessibility standards
- **Content structure**: Logical content flow for screen readers
- **Flexible content**: Slot allows for custom accessible content implementation
