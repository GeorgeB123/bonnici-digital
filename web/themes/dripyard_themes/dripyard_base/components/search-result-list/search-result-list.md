# Search Result List Component

A wrapper component for displaying search results that integrates with both Drupal core search functionality and the Search API module.

## Usage

```twig
{{ include('dripyard_base:search-result-teaser', {
    attributes,
    title_attributes,
    content_attributes,
    title_prefix,
    title_suffix,
    title,
    href: url,
    snippet,
    author: info_split.user,
    date: result.date|date('F j, Y'),
    content_type: result.type,
  }, with_context = false) }}

```
## Search Integration

### Core Search Results
Uses `item.value` property for Drupal core search results.

### Search API Results
Uses `item.content` property for Views Search API and advanced search recipe results.

## Grid Layout

- **Main content**: Search results span columns 1-8 in grid layout
- **Grid class**: Uses `grid--left-content` for layout positioning
- **Empty state**: Uses `content` grid area for no results message

## List Structure

- **Semantic markup**: Uses ordered list (`<ol>`) for search results
- **Clean styling**: Removes default list styles (margins, padding, bullets)
- **Item structure**: Each result wrapped in list item with component classes

## Related Elements

The component also styles related search elements:

- **Search form**: Bottom margin spacing for forms above results
- **Search help link**: Inline block display with margin spacing

## Accessibility Features

- **Semantic HTML**: Uses proper ordered list structure for results
- **Heading hierarchy**: Optional h3 heading for results section
- **Screen reader support**: Clear content structure for assistive technology
- **Empty state**: Proper messaging when no results are available

## Layout Integration

- **Grid system**: Integrates with theme's grid layout system
- **Content area**: Proper grid positioning for main content
- **Responsive**: Adapts to container constraints within grid layout
