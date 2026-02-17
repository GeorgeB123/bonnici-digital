# Dripyard Card Block Recipe

A Drupal block implementation of the card component designed for creating content cards with images, titles, body text, and optional links.

## Overview

The Dripyard Card block provides a Drupal-native way to create content cards using the underlying card component. Ideal for featured content, team members, articles, and general content presentation.

## Block Fields

### Eyebrow Field (`dripyard_eyebrow`)
- **Type**: Text (long)
- **Required**: No
- **Purpose**: Small text above the title (e.g., category, date)

### Title Field (`dripyard_title`)
- **Type**: Text (long)
- **Required**: No
- **Purpose**: The main card headline

### Image Field (`dripyard_image_media`)
- **Type**: Media reference
- **Required**: No
- **Purpose**: Card image

### Body Field (`body`)
- **Type**: Text with summary
- **Required**: No
- **Purpose**: Card content with basic formatting support

### Link Field (`dripyard_link`)
- **Type**: Link field
- **Required**: No
- **Purpose**: Makes the entire card clickable

## Technical Implementation

### Component Integration
The block integrates with the `[your-dripyard-theme]:card` component.

### Dependencies
This recipe requires:
- `dripyard_fields_block` - Provides common field storage definitions

## Usage

This block can be used anywhere in Layout Builder or as a standard block placement. Commonly used for:
- Content previews
- Team member profiles
- Product listings
- Article teasers
- Service descriptions

## Component Documentation

For detailed information about styling, layout options, and component capabilities, see the [card component documentation](/themes/[your-dripyard-theme]/components/dripyard/card/card.md).

## Troubleshooting

**Card layout not displaying correctly**
- Verify that the card component CSS is properly loaded
- Check that image media entities are properly configured
