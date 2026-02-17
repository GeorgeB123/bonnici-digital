# Search Result Teaser Component

A teaser component for displaying individual search results with metadata, snippet text, and optional images. Compatible with both Drupal core search and Search API.

## Usage

### Core Search Implementation
```twig
{{ include('dripyard_base:search-result-teaser', {
  title: result_title,
  href: result_url,
  snippet: result_snippet,
  author: author_name,
  date: 'January 15, 2024',
  content_type: 'Article',
  title_attributes: title_attributes,
  content_attributes: content_attributes,
  title_prefix: title_prefix,
  title_suffix: title_suffix
}, with_context = false) }}
```

### Search API Implementation
```twig
{{ include('dripyard_base:search-result-teaser', {
  title: fields.title.content,
  href: entity_url,
  snippet: fields.search_api_excerpt.content,
  date: formatted_date,
  content_type: content_type_label,
  image: featured_image
}, with_context = false) }}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `title` | string | Yes | The title of the search result |
| `href` | string | Yes | URL link to the full content |
| `snippet` | string | No | Excerpt or summary text from the content |
| `author` | string | No | Author name for the content |
| `date` | string | No | Formatted publication date |
| `content_type` | string | No | The type of content (e.g., Article, Page) |
| `image` | object | No | Optional featured image for the result |
| `title_attributes` | object | No | HTML attributes for the title element |
| `content_attributes` | object | No | HTML attributes for content elements |
| `title_prefix` | string | No | Content to display before the title |
| `title_suffix` | string | No | Content to display after the title |

## CSS Custom Properties

- `--search-result-teaser-gap` - Spacing between teaser elements

## Visual Layout

- **Article structure**: Uses semantic `<article>` element
- **Metadata header**: Content type, author, and date information
- **Title prominence**: H3 heading with h4 styling for hierarchy
- **Image float**: Optional 150px wide image floated to text start
- **Footer URL**: Shows the result URL with hover effects

## Content Structure

- **Meta information**: Content type, author (if available), and date
- **Linked title**: Clickable heading that leads to full content
- **Snippet text**: Excerpt with proper paragraph spacing
- **Footer URL**: Direct link display with hover interaction

## Image Integration

- **Float layout**: Images float to the inline-start of content
- **Fixed width**: 150px width with responsive behavior
- **Margin spacing**: Uses component gap for consistent spacing
- **Clear footer**: Footer clears floated content

## Accessibility Features

- **Semantic markup**: Uses `<article>` for proper content structure
- **Heading hierarchy**: H3 element maintains document outline
- **Link context**: Clear link text and URL display
- **Screen reader support**: Proper markup structure for assistive technology

## Search Integration

- **Dual compatibility**: Works with both core search and Search API
- **Flexible data**: Adapts to different data structures from search systems
- **Template integration**: Used in search-result.html.twig and Views templates
