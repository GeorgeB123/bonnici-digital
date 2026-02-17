# Dripyard Title CTA Block Recipe

A Drupal block implementation of the title-cta component designed for creating title sections with call-to-action buttons and flexible layout options.

## Overview

The Dripyard Title CTA block provides a Drupal-native way to create title sections with integrated call-to-action elements using the underlying title-cta component. Ideal for section headers, page introductions, and action-oriented content.

## Block Fields

### Title Field (`dripyard_title`)
- **Type**: Text (long)
- **Required**: No
- **Purpose**: The main section title or headline

### Call-to-Action Field (`dripyard_cta`)
- **Type**: Link field
- **Required**: No
- **Purpose**: Action button or link

### Component Layout Field (`dripyard_component_layout`)
- **Type**: List (string)
- **Required**: No
- **Purpose**: Controls the layout arrangement of title and CTA elements

## Technical Implementation

### Component Integration
The block integrates with the `[your-dripyard-theme]:title-cta` component.

### Dependencies
This recipe requires:
- `dripyard_fields_block` - Provides common field storage definitions

## Usage

This block can be used anywhere in Layout Builder or as a standard block placement. Commonly used for:
- Section headers
- Page introductions
- Call-to-action sections
- Content area titles
- Action-oriented headings

## Component Documentation

For detailed information about styling, layout options, and component capabilities, see the [title-cta component documentation](/themes/[your-dripyard-theme]/components/dripyard/title-cta/title-cta.md).

## Troubleshooting

**Layout not displaying correctly**
- Use the component layout field to control title and CTA arrangement
- Verify that the title-cta component CSS is properly loaded

**CTA button not styling properly**
- Check that the call-to-action field is properly configured
- Verify that button styling is applied correctly
