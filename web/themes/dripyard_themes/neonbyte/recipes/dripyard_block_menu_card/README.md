# Dripyard Menu Card Block Recipe

A Drupal block implementation of the menu-card component designed for creating navigation cards that reference menu items with images and links.

## Overview

The Dripyard Menu Card block provides a Drupal-native way to create navigation cards using the underlying menu-card component. Links to menu items and displays them with images in a card format.

## Block Fields

### Image Field (`dripyard_image_media`)
- **Type**: Media reference
- **Required**: No
- **Purpose**: Card image

### Link Field (`dripyard_link`)
- **Type**: Link field
- **Required**: No
- **Purpose**: Card destination link

### Menu Item Reference Field (`dripyard_menu_item_reference`)
- **Type**: Menu link content reference
- **Required**: No
- **Purpose**: References a menu item for navigation

## Technical Implementation

### Component Integration
The block integrates with the `[your-dripyard-theme]:menu-card` component.

### Menu Cards View
This recipe includes a view (`dripyard_menu_cards`) that can display multiple menu cards in a grid layout.

### Dependencies
This recipe requires:
- `dripyard_fields_block` - Provides common field storage definitions

## Usage

This block can be used anywhere in Layout Builder or as a standard block placement. Commonly used for:
- Section navigation
- Category browsing
- Featured menu items
- Visual navigation aids
- Service area displays

## Component Documentation

For detailed information about styling and component capabilities, see the [menu-card component documentation](/themes/[your-dripyard-theme]/components/dripyard/menu-card/menu-card.md).

## Troubleshooting

**Menu card not linking properly**
- Check that menu item references are properly configured
- Verify that link fields contain valid URLs

**Images not displaying**
- Check that image media entities are properly configured
- Verify image styles are available for menu cards
