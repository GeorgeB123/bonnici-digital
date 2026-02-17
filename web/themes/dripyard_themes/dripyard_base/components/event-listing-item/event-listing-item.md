# Event Listing Item Component

A component for displaying event information in a structured layout with date block, title, description, and event details. Designed for use in event listings.

## Usage

```twig
{{ include('dripyard_base:event-listing-item', {
  title: 'Summer Music Festival',
  url: '/events/summer-festival',
  date_time_stamp_begin: '2024-07-15T14:30:00Z',
  description: 'Join us for an amazing outdoor music experience featuring local artists.',
  formatted_time: '2:30 PM - 8:00 PM',
  location: 'Central Park Amphitheater'
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `title` | string | Yes | Event title/name |
| `url` | string | Yes | Link to event details page |
| `date_time_stamp_begin` | string | Yes | Event start date/time in ISO format |
| `description` | string | No | Event description text |
| `formatted_time` | string | No | Human-readable time display (e.g., "2:30 PM - 5:00 PM") |
| `location` | string | No | Event venue or location |

### Slots

| Slot | Description |
|------|-------------|
| `content_left` | Left content area (typically contains date block) |
| `content_center` | Center content area (title and description) |
| `content_right` | Right content area (time and location details) |

## CSS Custom Properties

- `--event-listing-item-gap` - Spacing between event listing sections
- `--event-listing-item-background-color` - Background color for event items
- `--event-listing-item-text-color` - Text color for event content

## Layout Structure

The component uses a three-column grid layout:

1. **First column**: Date block component displaying month and day
2. **Second column**: Event title (linked) and optional description
3. **Third column**: Event time and location details

## Responsive Behavior

- **Mobile**: Stacked vertical layout with reduced spacing
- **Tablet and up**: Three-column grid layout for optimal content organization
- **Container queries**: Adapts based on available container width

## Accessibility Features

- **Semantic article**: Uses `<article>` element for proper content structure
- **Accessible links**: Event title link provides clear navigation target
- **Time element**: Date block uses semantic `<time>` element with datetime attribute
- **Hierarchical headings**: Uses H3 for event titles to maintain heading hierarchy

## Integration

### Date Block Component
The event listing automatically includes the `date-block` component in the left content area, passing the `date_time_stamp_begin` value for date display.

### Event Data
Designed to work with Drupal event content types and can be integrated with:
- Event content types
- Calendar modules
- Custom event listing views
- Event management systems

## Content Guidelines

### Title
- Keep event titles concise and descriptive
- Use title case for proper names and events
- Avoid excessive punctuation

### Description
- Provide brief, engaging descriptions
- Focus on key event highlights
- Keep length appropriate for listing context

### Time and Location
- Use consistent time formatting across events
- Include full venue names when possible
- Consider time zone information for remote events
