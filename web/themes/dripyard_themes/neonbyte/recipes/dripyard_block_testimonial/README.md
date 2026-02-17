# Dripyard Testimonial Block Recipe

A Drupal block implementation of the testimonial component designed for displaying customer testimonials, reviews, and quotes with author information and images.

## Overview

The Dripyard Testimonial block provides a Drupal-native way to create testimonial content using the underlying testimonial component. Ideal for customer reviews, student testimonials, employee quotes, and social proof content.

## Block Fields

### Quote Field (`dripyard_quote`)
- **Type**: Text (long)
- **Required**: Yes
- **Purpose**: The main testimonial text or quote

### Citation Field (`dripyard_citation`)
- **Type**: Text (255 characters)
- **Required**: No
- **Purpose**: The person being quoted (e.g., "Sophie, 19", "John Doe, CEO")

### Image Field (`dripyard_image_media`)
- **Type**: Media reference (Image)
- **Required**: Yes
- **Purpose**: Photo of the person giving the testimonial

### Reverse Layout Field (`dripyard_reversed`)
- **Type**: Boolean (checkbox)
- **Required**: No
- **Purpose**: Reverses the layout (image on right instead of left)

## Technical Implementation

### Component Integration
The block integrates with the `dripyard_base:testimonial` component.

### Dependencies
This recipe requires:
- `dripyard_media` - Provides media handling
- `dripyard_fields_block` - Provides common field storage definitions

## Usage

This block can be used anywhere in Layout Builder or as a standard block placement. Commonly used for:
- Customer testimonials
- Student success stories
- Employee quotes
- Product reviews
- Social proof sections

## Component Documentation

For detailed information about styling, layout options, and component capabilities, see the [testimonial component documentation](/themes/neonbyte/_dripyard_base/components/testimonial/testimonial.md).

## Troubleshooting

**Testimonial layout not displaying correctly**
- Verify that the testimonial component CSS is properly loaded
- Check that image media entities are properly configured
- Ensure the theme supports the testimonial component

**Image not appearing**
- Verify the media reference is configured correctly
- Check that the image media type is available
- Ensure proper image permissions are set
