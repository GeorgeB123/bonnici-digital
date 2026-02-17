# Header Article Component

A specialized header component for article nodes featuring a title, metadata, tags, and optional large image with overlapping layout effects.

## Usage

```twig
{{ include('neonbyte:header-article', {
  title: article_title,
  tags: field_tags,
  author_name: author_name,
  date: publish_date,
  display_submitted: true,
  image: field_image
}, with_context = false) }}
```
### Slots

| Slot | Description |
|------|-------------|
| `image_content` | Featured image content block |
| `meta_content` | Author and date metadata block |

## CSS Custom Properties

- `--header-article-spacing` - Vertical spacing for header sections

## Layout Behavior

The component adapts based on image presence:

- **Without image**: Standard header with background gradient and bottom spacing
- **With image**: Extended padding and overlapping image effect with negative top margin

## Visual Effects

- **Background gradient**: Linear gradient from transparent to neutral color
- **Image overlap**: Featured image overlaps header content with -150px top margin
- **Full-width container**: Uses grid system with content area positioning
- **Responsive spacing**: Adapts padding and margins based on image presence

## Accessibility Features

- **Semantic markup**: Uses proper h1 for article title
- **Conditional rendering**: Image block only renders when content exists
- **Metadata structure**: Proper semantic structure for author/date information
