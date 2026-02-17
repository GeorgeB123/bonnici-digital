# Dripyard Media Block Recipe

A Drupal block implementation for displaying media content (images, videos) with full-width styling and optimized presentation.

## Overview

The Dripyard Media block provides a Drupal-native way to display media content with specialized view modes and styling. Designed for prominent media display with proper responsive handling.

## Block Fields

### Media Field (`dripyard_media`)
- **Type**: Media reference
- **Required**: No
- **Purpose**: The media item to display (image, video, etc.)

## Technical Implementation

### Media View Modes
This recipe includes specialized view modes for media display:
- `dripyard_full_width` - Full-width media display
- Image styles optimized for full-width presentation

### Dependencies
This recipe requires:
- `dripyard_fields_block` - Provides common field storage definitions

## Usage

This block can be used anywhere in Layout Builder or as a standard block placement. Commonly used for:
- Feature images
- Video content
- Gallery displays
- Full-width media sections
- Embedded media content

## Troubleshooting

**Media not displaying properly**
- Check that media entities are properly configured
- Verify that the dripyard_full_width view mode is available
- Check that image styles are generated for the media type

**Full-width styling not applied**
- Verify that the media block template is properly loaded
- Check that full-width CSS classes are applied
