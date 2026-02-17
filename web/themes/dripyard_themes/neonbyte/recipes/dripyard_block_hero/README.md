# Dripyard Hero Block Recipe

A Drupal block implementation of the hero component designed for creating prominent header sections with background images, titles, and call-to-action elements.

## Overview

The Dripyard Hero block provides a Drupal-native way to create large, visually impactful hero sections using the underlying hero component. Ideal for landing pages, featured content, and prominent page headers.

## Block Fields

### Title Field (`dripyard_title`)
- **Type**: Text (long)
- **Required**: No
- **Purpose**: The main hero headline

### Body Field (`body`)
- **Type**: Text with summary
- **Required**: No
- **Purpose**: Additional descriptive text below the title

### Image Field (`dripyard_image_media`)
- **Type**: Media reference
- **Required**: No
- **Purpose**: Background image for the hero

### Call-to-Action Field (`dripyard_ctas`)
- **Type**: Link field (multiple values)
- **Required**: No
- **Purpose**: Action buttons within the hero

### Theme Field (`dripyard_component_theme`)
- **Type**: List (string)
- **Required**: No
- **Purpose**: Visual theme variant selection

### Alignment Fields (`dripyard_align_x`, `dripyard_align_y`)
- **Type**: List (string)
- **Required**: No
- **Purpose**: Control content positioning within the hero

### Text Color Field (`dripyard_text_color`)
- **Type**: List (string)
- **Required**: No
- **Purpose**: Override text color for contrast

## Technical Implementation

### Component Integration
The block integrates with the `[your-dripyard-theme]:hero` component and passes content through slots for maximum flexibility.

### Dependencies
This recipe requires:
- `dripyard_block_hero_base` - Provides image styles and responsive image configurations
- `dripyard_text_formats` - Provides text formatting capabilities

## Usage

This block can be used anywhere in Layout Builder or as a standard block placement. Commonly used for:
- Landing page headers
- Feature announcements
- Product showcases
- Call-to-action sections

## Component Documentation

For detailed information about styling, accessibility features, responsive behavior, and component capabilities, see the [hero component documentation](/themes/[your-dripyard-theme]/components/dripyard/hero/hero.md).

## Troubleshooting

**Background image not displaying correctly**
- Check that the image media entity is properly configured
- Verify responsive image styles are generated

**Text not readable over background**
- Use the text color field to override automatic color selection
- Consider using a darker/lighter theme variant
