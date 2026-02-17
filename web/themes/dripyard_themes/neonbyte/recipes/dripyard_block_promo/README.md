# Dripyard Promo Block Recipe

A Drupal block implementation of the promo component designed for creating promotional content sections with eyebrows, titles, body text, and call-to-action elements.

## Overview

The Dripyard Promo block provides a Drupal-native way to create promotional content blocks using the underlying promo component. Ideal for featured content, announcements, and marketing sections.

## Block Fields

### Eyebrow Field (`dripyard_eyebrow`)
- **Type**: Text (long)
- **Required**: No
- **Purpose**: Small text above the title (e.g., "New Feature", "Limited Time")

### Title Field (`dripyard_title`)
- **Type**: Text (long)
- **Required**: No
- **Purpose**: The main promo headline

### Body Field (`body`)
- **Type**: Text with summary
- **Required**: No
- **Purpose**: Descriptive content with basic formatting support

### Call-to-Action Field (`dripyard_ctas`)
- **Type**: Link field (multiple values)
- **Required**: No
- **Purpose**: Action buttons or links

### Alignment Fields (`dripyard_align_x`, `dripyard_align_y`)
- **Type**: List (string)
- **Required**: No
- **Purpose**: Control content positioning within the promo

## Technical Implementation

### Component Integration
The block integrates with the `[your-dripyard-theme]:promo` component.

### Dependencies
This recipe requires:
- `dripyard_fields_block` - Provides common field storage definitions

## Usage

This block can be used anywhere in Layout Builder or as a standard block placement. Commonly used for:
- Featured announcements
- Product promotions
- Service highlights
- Call-to-action sections

## Component Documentation

For detailed information about styling, alignment options, theme variants, and component capabilities, see the [promo component documentation](/themes/[your-dripyard-theme]/components/dripyard/promo/promo.md).

## Troubleshooting

**Content not aligning properly**
- Use the alignment fields to control horizontal and vertical positioning
- Check that the promo component CSS is properly loaded
