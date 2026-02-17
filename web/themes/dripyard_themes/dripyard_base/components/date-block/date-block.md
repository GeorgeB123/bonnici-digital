# Date Block Component

A compact date display component that shows month and day in a calendar-style block format. Commonly used within event listings, articles, and other date-sensitive content.

## Usage

```twig
{{ include('dripyard_base:date-block', {
  date_time_stamp: '2024-07-15T14:30:00Z'
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `date_time_stamp` | string | Yes | ISO 8601 formatted date/time string |

## CSS Custom Properties

- `--date-block-padding-inline` - Horizontal padding for the date block
- `--date-block-border-radius` - Corner rounding for the date block
- `--date-block-background-color` - Background color for the date block
- `--date-block-text-color` - Text color for month and day
- `--date-block-font-size` - Font size for date text
- `--date-block-width` - Width and height dimensions of the date block

## Date Formatting

The component uses Twig's date filter with specific formats:
- **Month**: Three-letter abbreviation (Jan, Feb, Mar, etc.)
- **Day**: Numeric day without leading zeros (1, 2, 15, 31)

## Semantic HTML

- **Time element**: Uses semantic `<time>` element for accessibility
- **Datetime attribute**: Includes ISO 8601 datetime for machine readability

## Accessibility Features

- **Semantic time**: Proper `<time>` element with datetime attribute
- **Screen reader friendly**: Datetime attribute provides full date context
