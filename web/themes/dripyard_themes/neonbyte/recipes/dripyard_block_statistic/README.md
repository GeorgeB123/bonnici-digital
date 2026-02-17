# Dripyard Block: Statistic

This recipe provides a statistic block type for displaying numerical values with optional descriptive text.

## Overview

The Dripyard Statistic block allows content creators to showcase important statistics with:

- **Statistic Value** (required): The main numerical statistic with optional prefix/suffix (e.g., $2,400, 98%, 5000+)
- **First Line** (optional): First line of descriptive text (e.g., "Students")
- **Second Line** (optional): Second line of descriptive text (e.g., "Enrolled students from 45 countries")
- **Link** (optional): Optional link for the entire statistic block

## Installation

This recipe depends on the `dripyard_fields_block` recipe for shared field configurations.

## Field Mapping

The following fields are available for this block type:

- `dripyard_statistic` - For the main statistic value
- `dripyard_statistic_first_line` - For the first descriptive line
- `dripyard_statistic_second_line` - For the second descriptive line
- `dripyard_link` - For optional linking (shared field from dripyard_fields_block)

## Usage

After installing this recipe, content editors can create statistic blocks through the block content interface. The statistic component will automatically handle countup animations and proper formatting when rendered.
