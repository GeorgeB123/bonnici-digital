# Dripyard StarterKit

A starterkit for creating custom subthemes based on any Dripyard theme.

## Overview

This starterkit creates a new custom theme that extends your purchased Dripyard theme. Benefits include:

- **Safe customization**: Your changes won't be lost when updating the base theme
- **Automatic inheritance**: Inherits all features from the base theme
- **Easy updates**: Merge upstream bug fixes and improvements
- **Pre-configured**: Copies regions, config, and assets from the base theme

## Usage

### Basic Usage

Create a subtheme based on the first available Dripyard theme:

```bash
php web/core/scripts/drupal generate-theme --starterkit dripyard_starterkit my_custom_theme --path themes/dripyard_themes
```

You can safely ignore the `The source theme dripyard_starterkit does not have a version specified.` notice as we will not be running this again once your custom theme is created.

### Specify Base Theme

Target a specific Dripyard theme using the environment variable:

```bash
DRIPYARD_BASE_THEME=neonbyte php web/core/scripts/drupal generate-theme --starterkit dripyard_starterkit my_custom_theme --path themes/dripyard_themes
```

Available base themes: `neonbyte`, `greatlakes`, or any Dripyard theme in your installation.

## Directory Structure

The generated theme will be created alongside your Dripyard themes:

```
themes/dripyard_themes/
├── dripyard_base/          # Core Dripyard framework
├── neonbyte/               # Your purchased theme
├── greatlakes/             # Another purchased theme
└── my_custom_theme/        # Your new subtheme
```

## What Gets Generated

- **Theme info file** with correct base theme reference
- **Logo and assets** copied from the base theme
- **Configuration files** copied and updated with your theme name
- **Template files** with placeholders replaced

## Next Steps

1. **Enable your theme** in the Drupal admin (look for the "SUBTHEME: USE ME" screenshot)
2. **Customize** by overriding templates, adding CSS/JS, or modifying configuration
3. **Update safely** - base theme updates won't affect your customizations

