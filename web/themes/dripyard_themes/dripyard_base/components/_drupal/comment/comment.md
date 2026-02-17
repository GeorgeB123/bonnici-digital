# Comment Component

A responsive comment display component for Drupal that renders individual comments with author metadata, timestamps, and nested threading support.

## Overview

The comment component displays user-generated comments with proper semantic HTML structure, including author attribution, timestamps, and support for comment threading. It features responsive design with container queries and alternating background colors for improved readability.

## Usage

```twig
{% embed 'dripyard_base:comment' with {
  attributes: attributes.addClass(classes).setAttribute('data-drupal-selector', 'comment'),
  new_indicator_timestamp,
  author,
  time: elements['#comment'].getCreatedTime()|date('F j, Y'),
  parent,
  title,
  title_prefix,
  title_suffix,
  title_attributes,
  content,
  content_attributes,
} only %}
  {% block comment_content %}
    {{ content }}
  {% endblock %}
{% endembed %}
```
## Accessibility Features

- **Color contrast**: Text must meet 4.5:1 contrast ratio requirements
