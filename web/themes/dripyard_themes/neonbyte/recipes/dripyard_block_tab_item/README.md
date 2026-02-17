# Dripyard Tab Item Block Recipe

A Drupal block implementation of the tab component designed specifically for Layout Builder. Creates individual tab content blocks that work seamlessly within tab group layouts.

## Overview

The Dripyard Tab Item block provides a Drupal-native way to create tabbed content sections using the underlying tab component. Each block represents a single tab with a title, optional icon, and expandable body content, designed to be used within Layout Builder's Tab Group layout.

## Features

- **Layout Builder Integration**: Specifically designed for use in Layout Builder
- **Tab Group Compatible**: Intended for use in Tab Group layouts defined by the theme

## Block Fields

### Title Field (`dripyard_title`)
- **Type**: Text (long) with plain text format
- **Required**: No
- **Purpose**: The clickable tab title

### Icon Field (`dripyard_icon`)
- **Type**: Icon selection
- **Required**: No
- **Purpose**: Optional icon to display alongside the tab title

### Body Field (`body`)
- **Type**: Text with summary
- **Required**: No
- **Purpose**: The tab content area

## Usage in Layout Builder

### Primary Use Case: Tab Group Layout
This block is specifically designed to be used within the **Tab Group layout** provided by the theme:

1. In Layout Builder, select "Dripyard Tab Group" as your layout
2. Add multiple "Dripyard Tab Item" blocks to the tab group sections
3. Each block becomes an individual tab within the group

### Alternative Use: Custom Tab Wrapper
For advanced implementations, this block can be used within any wrapper that implements the tab group component functionality.

## Technical Implementation

### Component Integration
The block integrates with the `[your-dripyard-theme]:tab` component.

### Dependencies
This recipe requires:
- `dripyard_fields_block` - Provides common field storage definitions

## Content Creation Workflow

1. **Create Layout**: Add a "Dripyard Tab Group" layout section in Layout Builder
2. **Add Blocks**: Insert multiple "Dripyard Tab Item" blocks into the tab group
3. **Configure Content**:
   - Set descriptive titles for each tab
   - Add optional icons for visual context
   - Add rich content to the body fields

## Integration with Theme Layouts

### Tab Group Layout
The theme provides a dedicated "Dripyard Tab Group" layout that:
- Automatically applies tab group styling
- Handles proper tab navigation functionality
- Manages the visual container for multiple tab items

### Custom Implementations
When building custom layouts, ensure your wrapper:
- Implements the `tab-group` component
- Provides proper tab navigation functionality

## Component Documentation

For detailed information about styling, accessibility features, and component capabilities, see the [tab component documentation](/themes/[your-dripyard-theme]/components/dripyard/tabs/tab/tab.md).

## Troubleshooting

**Tabs not grouping properly**
- Ensure you're using the "Dripyard Tab Group" layout
- Check that all items are placed within the same tab group section

**Styling not applied correctly**
- Verify the theme is properly configured
- See tab component documentation for styling options
