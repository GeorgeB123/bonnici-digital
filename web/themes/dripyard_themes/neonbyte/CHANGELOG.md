# Change Log
All notable changes to this project will be documented in this file.

⚠️ Note that many changes will also be made in the `dripyard_base` theme. Peruse that CHANGELOG.md for more information.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## Next release

##  [1.1.0] - 2026-01-19
- Added support for using `background-image` component within `hero` component.
- New props added to `icon` component: `color`, `link_href`, `link_text`, and `open_new_window`. All new props are optional.
- Removed `title` prop from `hero`. Instead, use a `heading` component in the `hero_content` slot. Note that the template still prints `{{ title }}` for backwards compatibility. Note that the block template has also been updated.

## [1.0.6] - 2025-12-11

### Added
- Recipe installer for Canvas patterns with improved UI/UX
- Meta enums to all relevant components for improved UI consistency
- Canvas recipe as theme dependency

### Changed
- Heading sizes adjusted down at viewports below 450px to prevent horizontal scrolling
- Icon component moved to Dripyard Basic group
- Schema updates for Canvas demo compatibility
- Recipe labels and descriptions updated for clarity

### Fixed
- Header search JavaScript compatibility with placeholder block forms (#6)
- Components now properly excluded from Canvas UI where appropriate

## 1.0.5

### Added
- Menu template for main navigation to enable Canvas page builder compatibility
- Menu template for region-content to load sidenav when in Layout Builder content region

### Changed
- Hero block template refactored to use flex-wrapper layout
- Hero component updated to support video components in addition to images
- Hero component image handling improved for proper media field passthrough
- Header-search component schema corrected to use proper noUi syntax
- GitLab CI configuration adds -n flag to lint step

### Fixed
- Hero block template properly passes image field to hero component
- Documentation comments corrected in menu--region-header-second template
- Hero component schema uncomments canvas-image references for proper Canvas support

## [1.0.4] - 2025-10-07

### Added
- Complete configuration schema definitions for theme settings validation
- Header settings for full width, sticky, and transparency options

### Changed
- Updated hero component to remove hero_body slot for Canvas compatibility
- Enhanced hero block template to use button-group schema compatible with Canvas
- Improved hero component structure for better content width alignment
- Updated PHPstan compliance across multiple PHP classes
- Modified search form block configuration to use null for page_id

### Fixed
- Configuration schema validation errors resolved
- Hero component content width alignment issues
- Block content validation in hero_content slot rendering
- PHPstan level 6 compliance issues in HeaderSettings and RecipeInstaller
- Return type declarations in PageTitleBlock preprocessor

### Removed
- Hero body slot removed for Canvas integration
- Deprecated noUi syntax replaced
