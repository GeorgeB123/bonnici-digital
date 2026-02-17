# Dripyard Icon Card Block Recipe

A Drupal block implementation of the icon-card component designed for creating content cards featuring icons with titles, body text, and optional links.

## Overview

The Dripyard Icon Card block provides a Drupal-native way to create icon-focused content cards using the underlying icon-card component. Ideal for service features, benefits, process steps, and informational content.

## Block Fields

### Title Field (`dripyard_title`)
- **Type**: Text (long)
- **Required**: No
- **Purpose**: The main card headline

### Icon Field (`dripyard_icon`)
- **Type**: Icon selection
- **Required**: No
- **Purpose**: Featured icon for the card

### Icon Size Field (`dripyard_icon_size`)
- **Type**: List (string)
- **Required**: No
- **Purpose**: Controls the size of the icon

### Body Field (`body`)
- **Type**: Text with summary
- **Required**: No
- **Purpose**: Card content with basic formatting support

### Link Field (`dripyard_link`)
- **Type**: Link field
- **Required**: No
- **Purpose**: Makes the entire card clickable

### Orientation Field (`dripyard_orientation`)
- **Type**: List (string)
- **Required**: No
- **Purpose**: Controls icon and content layout (horizontal/vertical)

### No Background Field (`dripyard_no_background`)
- **Type**: Boolean
- **Required**: No
- **Purpose**: Removes background styling for minimal appearance

## Technical Implementation

### Component Integration
The block integrates with the `[your-dripyard-theme]:icon-card` component.

### Dependencies
This recipe requires:
- `dripyard_fields_block` - Provides common field storage definitions

## Usage

This block can be used anywhere in Layout Builder or as a standard block placement. Commonly used for:
- Service features
- Process steps
- Benefits listings
- How-it-works sections
- Feature comparisons

## Component Documentation

For detailed information about styling, orientation options, icon sizing, and component capabilities, see the [icon-card component documentation](/themes/[your-dripyard-theme]/components/dripyard/icon-card/icon-card.md).

## Troubleshooting

**Icon not displaying**
- Verify that the icon field is properly configured
- Check that the icon library is loaded

**Layout not appearing correctly**
- Use the orientation field to control icon and text placement
- Check the no background option if minimal styling is desired
