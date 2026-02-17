# Dripyard Logo Item Block Recipe

A Drupal block implementation of the logo-item component designed for creating individual logo displays with optional links. Typically used within logo grid layouts.

## Overview

The Dripyard Logo Item block provides a Drupal-native way to create individual logo displays using the underlying logo-item component. Each block represents a single logo with optional linking capability.

## Block Fields

### Image Field (`dripyard_image_media`)
- **Type**: Media reference
- **Required**: No
- **Purpose**: The logo image

### Link Field (`dripyard_link`)
- **Type**: Link field
- **Required**: No
- **Purpose**: Optional link destination for the logo

## Technical Implementation

### Component Integration
The block integrates with the `[your-dripyard-theme]:logo-item` component.

### Dependencies
This recipe requires:
- `dripyard_fields_block` - Provides common field storage definitions

## Usage

This block can be used anywhere in Layout Builder or as a standard block placement. Commonly used for:
- Client logos
- Partner displays
- Sponsor acknowledgments
- Technology stack displays
- Certification badges

### Logo Grid View
This recipe also includes a view (`dripyard_logo_grid`) that can display multiple logo items in a grid layout.

## Component Documentation

For detailed information about styling and component capabilities, see the [logo-item component documentation](/themes/[your-dripyard-theme]/components/dripyard/logo-grid/logo-item/logo-item.md).

## Troubleshooting

**Logo not displaying properly**
- Check that image media entities are properly configured
- Verify image styles are available for the media type

**Grid layout not working**
- Check that the logo grid view is properly configured
- Verify that multiple logo items are created
