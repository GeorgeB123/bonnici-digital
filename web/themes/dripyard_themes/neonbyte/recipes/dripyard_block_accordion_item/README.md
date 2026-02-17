# Dripyard Accordion Item Block Recipe

A Drupal block implementation of the accordion-item component designed specifically for Layout Builder. Creates individual collapsible content blocks that work seamlessly within accordion group layouts.

## Overview

The Dripyard Accordion Item block provides a Drupal-native way to create collapsible content sections using the underlying accordion-item component. Each block represents a single accordion item with a title and expandable body content, designed to be used within Layout Builder's Accordion Group layout or custom accordion group implementations.

## Features

- **Layout Builder Integration**: Specifically designed for use in Layout Builder
- **Accordion Group Compatible**: Intended for use in Accordion Group layouts defined by the theme

## Block Fields

### Title Field (`dripyard_title`)
- **Type**: Text (long) with plain text format
- **Required**: No
- **Purpose**: The clickable header text that toggles the accordion item
- **Format**: Plain text only for consistency and security

### Body Field (`body`)
- **Type**: Text with summary
- **Required**: No
- **Purpose**: The collapsible content area
- **Format**: Supports all allowed text formats for rich content

## Usage in Layout Builder

### Primary Use Case: Accordion Group Layout
This block is specifically designed to be used within the **Accordion Group layout** provided by the theme:

1. In Layout Builder, select "Dripyard Accordion Group" as your layout
2. Add multiple "Dripyard Accordion Item" blocks to the accordion group sections
3. Each block becomes an individual accordion item within the group

### Alternative Use: Custom Accordion Wrapper
For advanced implementations, this block can be used within any wrapper that implements the accordion group component functionality.

## Technical Implementation

### Dependencies
This recipe requires:
- `dripyard_fields_block` - Provides common field storage definitions
- `dripyard_text_format_superbasic` - Provides text formatting capabilities

## Content Creation Workflow

1. **Create Layout**: Add an "Dripyard Accordion Group" layout section in Layout Builder
2. **Add Blocks**: Insert multiple "Dripyard Accordion Item" blocks into the accordion group
3. **Configure Content**:
   - Set descriptive titles for each accordion item
   - Add rich content to the body fields
   - Use formatting as needed for readability

## Integration with Theme Layouts

### Accordion Group Layout
The theme provides a dedicated "Dripyard Accordion Group" layout that:
- Automatically applies accordion group styling
- Handles proper spacing between items
- Manages the visual container for multiple accordion items

### Custom Implementations
When building custom layouts, ensure your wrapper:
- Implements the `accordion-group` component
- Provides proper spacing and visual grouping

## Troubleshooting

**Accordion items not grouping properly**
- Ensure you're using the "Dripyard Accordion Group" layout
- Check that all items are placed within the same accordion group section

**Styling not applied correctly**
- Verify the theme is properly configured
- See accordion-item component documentation for styling options
