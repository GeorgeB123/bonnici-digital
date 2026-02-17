# Dripyard Event Listing Item Block

Provides an event listing item block type with event details, date, time, and location. This block is designed to work with the event-listing-item component in themes.

## Fields

- **Event Title** (required): The title of the event
- **Event URL** (required): Link to the event details page
- **Event Date/Time** (required): The start date and time of the event
- **Description** (optional): Brief description of the event (uses standard body field)
- **Event Location** (optional): The venue or location where the event takes place

## Usage

This block type is designed to be used with the `event-listing-item` component and can be used in:

- Event listing pages
- Event grid layouts
- Calendar views
- Homepage event features

## Related Components

This block works with the following theme components:
- `event-listing-item` - Main component for displaying event information
- `date-block` - Used for displaying the event date

## Field Storage

The following field storage definitions are created in `dripyard_fields_block`:
- `dripyard_date` - DateTime field for event start time
- `dripyard_location` - String field for event location

Reused fields from existing storage:
- `dripyard_title` - For event title
- `dripyard_link` - For event URL
- `body` - Standard Drupal body field, labeled as "Description"

**Note**: Formatted time display is handled in the template using the `dripyard_date` field.
