# Dripyard Base Theme

Dripyard Base serves as the foundational base theme for all Dripyard themes, providing a comprehensive component library with 50+ reusable components.

## Overview

This theme is designed as a **base theme only** and should not be installed directly. Instead, it provides shared components, styles, and functionality for child themes in the Dripyard ecosystem.

## Key Features

- **Component-driven architecture** with 59+ Single Directory Components (SDCs)
- **Multi-page builder compatibility**: Works with Drupal Canvas, Layout Builder, and Paragraphs
- **Advanced color system** with 4-layer architecture and WCAG 2.2 AA compliance
- **Sophisticated CSS architecture** with logical properties and performance-first loading
- **Object-oriented preprocessing system** for clean, maintainable code
- **Extensive utility classes** for rapid development

## Component Library

The theme includes 50+ Single Directory Components organized into several categories:

### Core Components
- **Layout Components**: Flex wrapper, dynamic layout
- **UI Components**: Buttons, cards, icons, pills, headings, text
- **Content Components**: Testimonials, statistics, accordions, tabs, carousels
- **Media Components**: Video players, images, YouTube embeds
- **Navigation**: Menus, breadcrumbs, pagers, social media nav

### Drupal Integration Components
- **Form Elements**: Details, fieldsets, form elements with preprocessing
- **Content Types**: Comments, status messages, local actions
- **Admin UI**: Skip links, unpublished badges, language switcher

## Component Architecture

Components reside in `components/` directory with logical groupings.
- Most components define schema in `*.component.yml`
- Non-reusable components omit schemas
- Each component includes comprehensive documentation

Built using Drupal's Single Directory Components (SDC) framework.

Components are highly configurable through two mechanisms:

### Component Props
Each component defines configurable properties in its `*.component.yml` schema file, allowing you to:
- Modify appearance and behavior through standardized interfaces
- Configure layout options, spacing, alignment, and themes
- Control content display and functionality
- Ensure type safety and validation

### CSS Variables
Components expose extensive CSS custom properties for fine-grained control:
- Override colors, spacing, typography, and effects
- Maintain consistency with design system tokens
- Customize within your subtheme for upgrade safety
- Enable component-level theming and variations

This dual approach provides both user-friendly configuration options and deep customization capabilities for developers.

## Theme Settings

The theme provides several configurable options through Drupal's theme settings interface:

- **Primary Color Configuration**: Set your brand's primary color, which automatically generates color palettes
- **Typography Settings**: Configure font families and sizing scales
- **Layout Options**: Adjust container widths and spacing values
- **Component Behavior**: Control animations, transitions, and progressive enhancement features


## CSS Variable Architecture

The theme uses a comprehensive CSS custom property system organized into logical groups:

### Typography Variables
**File**: `css/_variables/variables-typography.css`

The typography system provides three font stacks:
- **Serif fonts**: Traditional serif typefaces
- **Sans-serif fonts**: Modern sans-serif typefaces
- **Monospace fonts**: Code and technical content

**Available Typography Scales**:
- `title` - Large display text
- `h1` through `h6` - Semantic headings
- `body-l`, `body-m`, `body-s` - Body text sizes

Each typography scale includes variables for:
- Font family, size, weight, line-height
- Letter-spacing and margins
- Responsive scaling values

### Layout Variables
**File**: `css/_variables/variables-layout.css`

The layout system provides consistent spacing and sizing:

**Spacing System**:
- Base spacing unit (`--sp`) with incremental values
- Gap variables for grid and flexbox layouts
- Semantic spacing variables:
  - `--spacing-component` - Space between components
  - `--spacing-component-internal` - Space within components

**Container & Layout**:
- Max-width constraints for content areas
- Breakpoint values for responsive design
- Grid and flexbox spacing utilities

### Form Variables
**File**: `css/_variables/variables-forms.css`

Form styling variables include:
- Form field backgrounds and borders
- Input spacing and sizing
- Focus states and validation styling
- Button and control element styling

### Color System

The color system uses a sophisticated 4-layer architecture that provides flexibility while maintaining WCAG 2.2 AA accessibility compliance:

#### Theme Settings Layer

Configure your primary brand color through your theme's settings page. This creates a `--theme-setting-base-primary-color` CSS variable and applies either `primary-color-is-dark` or `primary-color-is-light` CSS classes to guide text contrast.

#### Semantic Layer
Using the native CSS `OKLCH()` function, the system generates primary and neutral color palettes with ten variations each, stored in `/css/_variables/variables-colors-semantic.css`.

#### Theme Layer
Five built-in themes (White, Light, Primary, Dark, Black) located in `/css/themes/` organize semantic colors into working color schemes with variables for:
- **Surfaces**: `--theme-surface`, `--theme-surface-alt`, `--theme-surface-primary`
- **Text**: `--theme-text-color-soft/medium/loud/primary`, `--theme-link-color/hover`
- **Borders/Icons**: `--theme-border-color/alt/soft`
- **Focus**: `--theme-focus-ring-color`
- **Status**: `--theme-color-error/warning/success/info`
- **Buttons**: Various surface and text color combinations

#### Component Layer
Each component defines its own CSS variables that map exclusively to theme layer variables, ensuring consistent theming. Apply theme classes (`.theme--dark`, `.theme--light`, etc.) to any component or ancestor element to switch themes while maintaining accessibility contrast ratios.

## Utility Classes

The theme provides an extensive set of utility classes for rapid development:

---

## CSS Architecture

* CSS classes are loosely named based on the [BEM](https://getbem.com/) CSS naming methodology. This aligns with Drupal core's coding standards.
* CSS is scoped to components whenever possible
* No global build system or dependency tree
* CSS loads only when needed (performance-first philosophy)
* CSS logical properties are used for `right` and `left` properties. This lets the theme easily adapt to RTL languages. Note that we do not use CSS logical properties for `top` and `bottom` properties, as the theme does not support flipping the X and Y axis.
* The theme heavily utilizes progressive enhancement and graceful degradation, which is the concept that we should support features in more modern browsers as long as it does not degrade the usability in older browsers. An example of this is the new `interpolate-size` property (currently only supported by Chromium at the time of this writing). If the browser supports this, various disclosures (e.g. accordions) will animate on open/close if the users' preference permits.

---

## Layout & Container System

The layout system uses a combination of `query-container`, `region-container`, and `full-width` wrappers to:

* Prevent horizontal scrollbars
* Support responsive breakout elements
* Handle off-canvas admin UI

### CSS Utility Classes:

* `.component-spacer`: Wraps landing page components ensuring equal spacing between each. This class is added to the wrapper around the `dripyard_landing_page` node template. Note that we do apply spacing at the component level in order to make the components more modular. An example of this would be injecting an accordion group into a hero (we wouldn't want component spacing there).
* `.query-container`: Wraps non-fixed Drupal regions and enables `cqw` unit calculations.
* `.region-container`: Max-width container within query-container.
* `.full-width`: Expands to full page width, even with off-canvas UI.
* `.full-height`: Tells `.component-spacer` to not apply vertical spacing.
* `.container`: Used for nested layout inside full-width elements.

* `.visibility-hidden`: Hides elements using `visibility: hidden`

**Layout Utilities:**
* **Gutters**: `.gutter-column--0/s/m/l` and `.gutter-row--0/s/m/l` for controlling grid spacing
* **Margins**: `.margin-top--0/s/m/l` and `.margin-bottom--0/s/m/l` with `:first-child` and `:last-child` overrides
* **Padding**: `.padding-top--0/s/m/l` and `.padding-bottom--0/s/m/l` for internal spacing

**Typography Utilities:**
* **Heading Styles**: `.heading-title`, `.h1` through `.h6` apply semantic heading typography
* **Body Text**: `.body-l`, `.body-m`, `.body-s` for different body text sizes
* **Color Classes**: `.color--soft/medium/loud/primary` for text color variations mapped to theme variables

---

## Preprocessing System

The theme uses an object-oriented preprocessing architecture to maintain clean, reusable code outside of the `.theme` file.

### Architecture
- **Location**: `./src/Preprocess/`
- **Interface**: All preprocessors implement `PreprocessInterface`
- **Organization**: Grouped by functionality (Field, Input, Menu, etc.)

### Key Features
- **Field Preprocessing**: Converts complex field data into simple component props
  - Example: `dripyard_link` field → `props.dripyard_link` with clean HTML attributes
- **Block Integration**: Primary focus on blocks, converting render arrays to SDC props
- **Input Processing**: Handles form element preprocessing for consistent styling
- **Special Handling**: Custom logic for Views integration (see [Drupal core issue #2704331](https://www.drupal.org/project/drupal/issues/2704331))

### Available Preprocessors
- **Field Processors**: `RichTextContent` for content formatting
- **Input Processors**: `TextInputPreprocessor`, `BooleanInputPreprocessor`, `TitleAttributePreprocessor`
- **Menu Processors**: `MenuCard` for navigation components
- **Page Title**: `ShortcutProcessor` for admin shortcuts integration

### Reducing Unneeded Markup

Drupal is notoriously markup heavy. We reduce Drupal's markup overhead by using `field--bare.html.twig` via the core `|add_suggestion()` Twig filter. Alternative solutions include [Fences](https://www.drupal.org/project/fences) and [No Markup](https://www.drupal.org/project/nomarkup) modules.

---

## Getting Started

### Installation
This theme is designed to be used as a base theme. Add it as a dependency in your child theme's `info.yml` file:

```yaml
base theme: dripyard_base
```

### Development Workflow
1. **Component Development**: Create new components in your child theme using the SDC structure
2. **Styling**: Extend or override variables in your child theme's CSS files
3. **Preprocessing**: Add custom preprocessing by extending the base classes
4. **Testing**: Use the built-in component development templates for testing

## Module Integration

### Recommended Modules
- **[UI Icons](https://www.drupal.org/project/ui_icons)**: Provides icon picker support for components
- **Core Navigation Module**: Modern replacement for traditional tabs with flexible top bar
- **[Better Exposed Filters](https://www.drupal.org/project/better_exposed_filters)**: Enhanced styling for Views filters
- **[Layout Builder](https://www.drupal.org/project/drupal/issues/2796173)**: Core layout building with enhanced component integration

### Supported Page Builders
- **Drupal Canvas**: Full component integration with visual editing
- **Layout Builder**: Core layout building with component support
- **Paragraphs**: Traditional paragraph-based content building

---
