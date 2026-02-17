# Dripyard Button Block Recipe

A Drupal block implementation of the button component designed for creating standalone call-to-action buttons with customizable styling and icons.

## Overview

The Dripyard Button block provides a Drupal-native way to create individual buttons using the underlying button component. Ideal for standalone calls-to-action, form submissions, and navigation elements.

## Block Fields

### Link Field (`dripyard_link`)
- **Type**: Link field
- **Required**: No
- **Purpose**: The button destination and text

### Button Style Field (`dripyard_button_style`)
- **Type**: List (string)
- **Required**: No
- **Purpose**: Visual style variant (primary, secondary, etc.)

### Button Size Field (`dripyard_button_size`)
- **Type**: List (string)
- **Required**: No
- **Purpose**: Size variant (small, medium, large)

### Icon Field (`dripyard_icon`)
- **Type**: Icon selection
- **Required**: No
- **Purpose**: Optional icon to display with the button

### Suffix Icon Field (`dripyard_suffix_icon`)
- **Type**: Icon selection
- **Required**: No
- **Purpose**: Optional icon to display after the button text

## Technical Implementation

### Component Integration
The block integrates with the `[your-dripyard-theme]:button` component.

### Dependencies
This recipe requires:
- `dripyard_fields_block` - Provides common field storage definitions

## Usage

This block can be used anywhere in Layout Builder or as a standard block placement. Commonly used for:
- Call-to-action buttons
- Download links
- Form submissions
- Navigation elements
- Contact buttons

## Component Documentation

For detailed information about styling, size options, icon usage, and component capabilities, see the [button component documentation](/themes/[your-dripyard-theme]/components/dripyard/button/button.md).

## Troubleshooting

**Button not displaying correctly**
- Verify that the button component CSS is properly loaded
- Check that style and size options are properly configured

**Icons not appearing**
- Verify that the icon field is properly configured
- Check that the icon library is loaded
