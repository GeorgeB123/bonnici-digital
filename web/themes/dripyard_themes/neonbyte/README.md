# Neonbyte Theme

Thanks for choosing **Neonbyte**. This theme reflects hundreds of hours of development and is designed to look beautiful out of the box while providing extensibility through best practices, WCAG 2.2 AA accessibility compliance, minimal technical debt, high performance, and flexible component-driven architecture.

## Table of Contents

- [Neonbyte Theme](#neonbyte-theme)
  - [Table of Contents](#table-of-contents)
  - [Key Features](#key-features)
  - [Quick Start](#quick-start)
    - [Theme Configuration](#theme-configuration)
  - [How to use this theme](#how-to-use-this-theme)
  - [Theme Architecture](#theme-architecture)
    - [Base Theme (dripyard\_base)](#base-theme-dripyard_base)
    - [Neonbyte Theme](#neonbyte-theme-1)
    - [Subtheme (Recommended)](#subtheme-recommended)
  - [Layout Builder Integration](#layout-builder-integration)
    - [Layout Sections](#layout-sections)
  - [Version Support](#version-support)
    - [Drupal 11.2+](#drupal-112)
  - [Component Architecture](#component-architecture)
    - [Component Props](#component-props)
    - [CSS Variables](#css-variables)
    - [Reducing unneeded markup](#reducing-unneeded-markup)
  - [Accessibility](#accessibility)
  - [Color System](#color-system)
    - [Theme Settings Layer](#theme-settings-layer)
    - [Semantic Layer](#semantic-layer)
    - [Theme Layer](#theme-layer)
    - [Component Layer](#component-layer)
  - [CSS Architecture](#css-architecture)
  - [Layout \& Container System](#layout--container-system)
  - [Theme Regions](#theme-regions)
    - [Header Regions](#header-regions)
    - [Content Regions](#content-regions)
    - [Fixed Regions](#fixed-regions)
    - [Footer Regions](#footer-regions)
  - [Preprocess System](#preprocess-system)
  - [Recommended Modules](#recommended-modules)
  - [Components](#components)
    - [Header \& Navigation Components](#header--navigation-components)
    - [Utility Components](#utility-components)
    - [Inherited Components](#inherited-components)

---

## Key Features

- Out-of-the-box modern design
- Fully translatable including RTL language support
- Component-driven architecture using Single Directory Components (SDC)
- WCAG 2.2 AA accessibility compliance including forced colors mode, focus management, and reduced motion support
- Dynamic color and component-based theming system
- No front-end build tools required
- No module dependencies on Drupal 11+
- Core-only APIs with no opinionated content model
- Performance-optimized asset loading
- Basic usage if JavaScript is unavailable

---

## Quick Start

Install Neonbyte at **Appearance > Add Theme** with no license keys or remote callbacks required.

### Theme Configuration

Configure your brand at `/admin/appearance/settings/neonbyte`:

- **Theme Colors**: Set primary color and color scheme (see [Color System](#color-system))
- **Logo & Branding**: Upload logo and favicon
- **Header Settings**: Configure header width, stickiness, transparency, and color theme
- **Footer Settings**: Select footer color theme (Primary, White, Light, Dark, Black)
- **Social Media**: Add links to your social media profiles
- **Recipe Installation**: Apply optional DripYard recipes for content types and demo content

---

## How to use this theme

This theme is meant to get you 90-99% of the way there. It has best practices and opinionated logical defaults baked in, but does not dictate your content architecture. This means that you will need to map data to your components. This is most frequently done within the component's template file, but can also be done within PHP, or a contributed module such as [SDC Display](https://www.drupal.org/project/sdc_display) or (coming soon) [Drupal Canvas](https://drupal.org/project/canvas).


## Theme Architecture

Neonbyte follows a sophisticated multi-layer architecture designed for maintainability and upgrades:

### Base Theme (dripyard_base)
- **Foundation Layer**: Provides core functionality, base styles, and shared utilities
- **Component Library**: Houses the complete Single Directory Components library shared across all DripYard themes
- **Framework**: Contains preprocessing system, theme settings infrastructure, and accessibility features
- **Bundled**: Included with Neonbyte installation, no separate download required

### Neonbyte Theme
- **Style Layer**: Applies Neonbyte-specific design tokens, colors, and visual treatments
- **Configuration**: Extends base theme settings with Neonbyte-specific options
- **Component Overrides**: Customizes base components for the Neonbyte aesthetic

### Subtheme (Recommended)
- **Customization Layer**: For all site-specific modifications and extensions
- **Future-Proof**: Protects customizations during theme updates
- **Override Capability**: Can override any component, style, or functionality from parent themes
- **Best Practice**: Always make changes in a subtheme rather than modifying Neonbyte directly

This architecture ensures clean separation of concerns while maintaining upgrade compatibility.

---

## Layout Builder Integration

Landing page recipe utilizes Layout Builder for content construction. Compatible with other page builders (Paragraphs, UI Suite), but Layout Builder is chosen for core inclusion.

### Layout Sections

Neonbyte includes a **Dynamic Layout** component that enables flexible grid layouts with 1-4 columns and 1-4 rows. This component supports:

- **Flexible Grid System**: Create 1, 2, 3, or 4 column layouts with configurable rows
- **Content Width Control**: Choose from `edge-to-edge`, `max-width`, or `narrow` content widths
- **Column Proportions**: Customize 2-column (50/50, 25/75, 33/67, 75/25, 67/33) and 3-column ratios (33/33/33, 50/25/25, 25/50/25, 25/25/50)
- **Advanced Spacing**: Control margins, padding, and gutters with options for zero, small, medium, large, or default spacing
- **Alignment Options**: Set horizontal (start, center, end) and vertical (top, center, bottom) content alignment
- **Theme Integration**: All five theme variants (white, light, primary, dark, black) supported

The layout uses CSS Grid for responsive behavior and provides up to 16 content slots (cells) based on your column × row configuration.

## Version Support

### Drupal 11.2+
No dependencies required.

---

## Component Architecture

*Neonbyte inherits the component architecture from dripyard_base. For complete component architecture documentation, see [dripyard_base component architecture](../dripyard_base/README.md#component-architecture).*

---


## Accessibility

Neonbyte is fully WCAG 2.2 AA compliant. Most components' documentation includes an **Accessibility** section. However, site authors should still test their sites and apply best practices to maintain accessibility.

---

## Color System

*Neonbyte inherits the complete 4-layer color system from dripyard_base. For detailed color system documentation, see [dripyard_base color system](../dripyard_base/README.md#color-system).*

---

## CSS Architecture

*Neonbyte inherits the CSS architecture from dripyard_base. For complete CSS architecture documentation, see [dripyard_base CSS architecture](../dripyard_base/README.md#css-architecture).*

---

## Layout & Container System

*Neonbyte inherits the layout and container system from dripyard_base. For complete documentation of utility classes, layout system, and container architecture, see [dripyard_base layout system](../dripyard_base/README.md#layout--container-system).*

---

## Theme Regions

Neonbyte defines strategic regions for flexible content placement throughout your site. Each region is optimized for specific content types and use cases.

**Verified regions from neonbyte.info.yml:**

### Header Regions

- **`header_first`** - Header first (logo)
  - Primary location for site branding and logo
  - Typically contains the site logo or title
  - Left-aligned on desktop layouts

- **`header_second`** - Header second (center)
  - Central header area for primary navigation
  - Main menu placement (any menus will automatically inherit the `primary-menu` component)
  - Search functionality (optional)

- **`header_third`** - Header third (right)
  - Right-aligned header content
  - Secondary navigation (any menus will automatically inherit the `secondary-menu` component)
  - Language switchers
  - CTAs

### Content Regions

- **`highlighted`** - Highlighted
  - Above main content area
  - Site-wide announcements or alerts
  - Featured promotions or important notices
  - This region features styling that creates a light background from to the top of the viewport.

- **`content`** - Content
  - Primary content area
  - Main page content, articles, landing pages
  - Layout Builder content when using landing pages

### Fixed Regions

- **`fixed_middle_right`** - Fixed middle right (local actions tabs)
  - Local action buttons and tabs
  - Positioned on right side of viewport
  - Primarily for authenticated users with appropriate permissions

- **`fixed_bottom_right`** - Fixed bottom right (messages)
  - System status messages (success, error, warning notifications)
  - Fixed positioning for consistent visibility

### Footer Regions

- **`footer_top`** - Footer top
  - Primary footer content area
  - Main footer navigation, site information
  - Can accommodate multiple columns of content

- **`footer_left`** - Footer left
  - Left column of footer content
  - Company information, contact details
  - Secondary navigation menus

- **`footer_right`** - Footer right
  - Right column of footer content
  - Social media links, newsletter signup
  - Additional contact information or links

- **`footer_bottom`** - Footer bottom
  - Copyright notices, legal information
  - Final footer content, typically minimal
  - Terms of service, privacy policy links

---

## Preprocess System

*Neonbyte inherits the preprocessing system from dripyard_base. For complete preprocessing system documentation, see [dripyard_base preprocessing system](../dripyard_base/README.md#preprocessing-system).*

---

## Recommended Modules

* [UI Icons](https://www.drupal.org/project/ui_icons): Icon picker support
* Core Navigation Module: Replaces tabs with a flexible top bar

---

## Components

Neonbyte includes **10 theme-specific components** that extend the base theme:

### Header & Navigation Components
- **footer** - Custom footer with Neonbyte styling and theme integration
- **header** - Main site header with navigation, branding, and responsive behavior
- **header-article** - Article-specific header layout for content pages
- **hero** - Landing page hero sections with call-to-action elements
- **header-search** - Integrated header search functionality with autocomplete
- **mobile-nav-button** - Mobile navigation toggle with accessibility features
- **primary-menu** - Primary navigation menu component with dropdown support
- **language-switcher** - Multi-language selection interface

### Utility Components
- **html-header** - Document head, metadata, and page initialization
- **icon** - Flexible icon display component with UI Icons integration

### Inherited Components
Neonbyte inherits **50+ additional components** from dripyard_base, including layout components, UI elements, content components, media components, form elements, and Drupal integration components.

For complete component documentation, see:
- Neonbyte components: `components/` directory
- Base components: See [dripyard_base documentation](../dripyard_base/README.md#component-library)
