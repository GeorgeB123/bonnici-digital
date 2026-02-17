# Dripyard Card Full Image Block Recipe

A Drupal block implementation of the card-full-image component designed for creating image-focused cards with overlay text and links.

## Overview

The Dripyard Card Full Image block provides a Drupal-native way to create visually striking cards using the underlying card-full-image component. Features a full-background image with overlay text, ideal for hero-style cards and visual content.

## Block Fields

### Title Field (`dripyard_title`)
- **Type**: Text (long)
- **Required**: No
- **Purpose**: The main card headline displayed over the image

### Image Field (`dripyard_image_media`)
- **Type**: Media reference
- **Required**: No
- **Purpose**: Full-background image for the card

### Link Field (`dripyard_link`)
- **Type**: Link field
- **Required**: No
- **Purpose**: Makes the entire card clickable

### Overlay Color Field (`dripyard_overlay_color`)
- **Type**: List (string)
- **Required**: No
- **Purpose**: Controls the color overlay for text readability

## Technical Implementation

### Component Integration
The block integrates with the `[your-dripyard-theme]:card-full-image` component.

### Dependencies
This recipe requires:
- `dripyard_fields_block` - Provides common field storage definitions

## Usage

This block can be used anywhere in Layout Builder or as a standard block placement. Commonly used for:
- Feature highlights
- Category navigation
- Visual storytelling
- Hero-style content cards
- Image galleries with text overlays

## Component Documentation

For detailed information about styling, overlay options, and component capabilities, see the [card-full-image component documentation](/themes/[your-dripyard-theme]/components/dripyard/card-full-image/card-full-image.md).

## Troubleshooting

**Text not readable over image**
- Use the overlay color field to improve text contrast
- Ensure images have appropriate contrast for text overlay

**Image not displaying properly**
- Check that image media entities are properly configured
- Verify responsive image styles are generated
