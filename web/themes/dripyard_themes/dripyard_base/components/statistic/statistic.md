# Statistic Component

An animated statistic component that displays numerical data with optional prefix/suffix text and supporting lines. Features smooth count-up animations using [CountUp.js](https://github.com/inorganik/countUp.js) with accessibility considerations and customizable styling.

## Usage

```twig
{{ include('greatlakes:statistic', {
  statistic: '$2,400',
  first_line: 'Students',
  second_line: 'Enrolled students from 45 countries',
  href: 'https://www.example.com'
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `statistic` | string | Yes | The main statistic value (can include prefix/suffix text like $, %, +, etc.) |
| `first_line` | string | No | Primary descriptive text displayed below the statistic |
| `second_line` | string | No | Secondary descriptive text for additional context |
| `href` | string | No | Optional URL to make the entire statistic a clickable link |

## Animation Features

### CountUp.js Integration
- **Library**: Uses [CountUp.js](https://github.com/inorganik/countUp.js) for smooth number animations
- **Smart parsing**: Automatically detects and preserves prefix/suffix text (e.g., $, %, +, €, ppm)
- **Number formatting**: Respects commas as thousand separators and decimal places
- **Viewport activation**: Animation triggers when the statistic enters the viewport using Intersection Observer

### Accessibility Considerations
- **Reduced motion**: Respects `prefers-reduced-motion` user preference - animations disabled for users who prefer reduced motion
- **Performance**: Uses Intersection Observer instead of scroll events for better performance
- **Semantic markup**: Proper structure for screen readers

### Supported Number Formats
- **Currencies**: $1,200, €500, ¥1000
- **Percentages**: 98%, 45.5%
- **Suffixed values**: 5000+, 200ppm
- **Decimal values**: 3.14, 98.6
- **Large numbers**: 1,200,000 (with comma separators)

## CSS Custom Properties

### Statistic Text Styling
- `--stat-stat-text-color` - Default color for the main statistic number (theme loud text)
- `--stat-stat-text-color-hover` - Hover state color for linked statistics (theme primary text)
- `--stat-stat-font-size` - Font size for the statistic number (5.5rem/88px, responsive to 3.75rem/60px on narrow containers)

### First Line Styling
- `--stat-first-line-font-size` - Font size for the first descriptive line (h3 size)
- `--stat-first-line-text-color` - Color for the first line text (theme medium text)

### Second Line Styling
- `--stat-second-line-font-size` - Font size for the second descriptive line (body large size)
- `--stat-second-line-text-color` - Color for the second line text (theme primary text)

## Container Queries

The component uses container queries for responsive typography:

```css
@container (width < 300px) {
  --stat-stat-font-size: 3.75rem; /* 60px */
}
```

- **Narrow containers** (< 300px): Smaller statistic font size for better fit
- **Default containers**: Full-size display with larger statistic numbers

## JavaScript Configuration

### Customizable Settings
The grouping separator can be modified in the JavaScript file:
```javascript
const groupingSeparator = ',';
```
