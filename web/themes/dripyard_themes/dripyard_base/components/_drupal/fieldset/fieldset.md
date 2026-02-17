# Fieldset Component

A form grouping component that provides semantic structure for related form elements with a styled legend and customizable appearance.

## Overview

The fieldset component is a fundamental form element used to group related form controls together. It features a legend title, support for required field indicators, error states, and consistent styling that integrates with Drupal's form system.

## Usage

```twig
{% embed 'dripyard_base:fieldset' with {
  legend_title: 'Personal Information',
  required: true
} %}
  {% block fieldset_content %}
    <!-- Form elements go here -->
    <div class="form-item">
      <label for="first_name">First Name</label>
      <input type="text" id="first_name" name="first_name">
    </div>
    <div class="form-item">
      <label for="last_name">Last Name</label>
      <input type="text" id="last_name" name="last_name">
    </div>
  {% endblock %}
{% endembed %}
```

### Props

| Property | Type | Required | Description |
|----------|------|----------|-------------|
| `legend_title` | string | Yes | The title text displayed in the fieldset legend |
| `required` | boolean\|null | No | Adds required form styling and visual indicator |

### Slots

| Slot | Description |
|------|-------------|
| `fieldset_content` | Main content area for form elements and controls |

## CSS Custom Properties

The component uses the following CSS variables for customization:

- `--fieldset-border-color` - Sets the border color around the fieldset
- `--fieldset-border-width` - Controls the thickness of the fieldset border
- `--fieldset-border-radius` - Controls the corner rounding of the fieldset
- `--fieldset-background-color` - Sets the background color of the fieldset
- `--fieldset-text-color` - Controls the text color within the fieldset
- `--fieldset-legend-text-color` - Sets the color of the legend text
- `--fieldset-padding-block` - Controls the vertical padding inside the fieldset
- `--fieldset-padding-inline` - Controls the horizontal padding inside the fieldset

## Error States

The component automatically handles error states:

```css
.fieldset.error {
  --fieldset-border-color: var(--theme-color-error);
  --fieldset-border-width: 2px;
}
```

When an error class is applied, the fieldset displays with error styling including a thicker, error-colored border.

## Accessibility Features

### Semantic Structure
- **Native fieldset**: Uses proper `<fieldset>` and `<legend>` elements for semantic form grouping
- **Screen reader support**: Legend provides context for grouped form controls
- **Keyboard navigation**: Standard tab order through form elements

### Required Field Indicators
- **Visual indicators**: SVG-based required markers using CSS masks
- **Screen reader compatible**: Mask images prevent screen readers from announcing decorative content
- **Color independence**: Required indicators work in high contrast mode

### Error Handling
- **Visual feedback**: Clear error state styling with enhanced borders
- **Contextual grouping**: Error states apply to the entire related group of form elements

## Related Components

- **Details**: For collapsible content grouping
- **Form Elements**: Input fields, textareas, selects that go inside fieldsets
- **Form Wrapper**: Parent form containers
- **Validation Messages**: Error and help text components

## Examples

### Basic Fieldset
```twig
{% embed 'dripyard_base:fieldset' with {
  legend_title: 'Contact Information'
} %}
  {% block fieldset_content %}
    <div class="form-item">
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email">
    </div>
  {% endblock %}
{% endembed %}
```

### Required Fieldset
```twig
{% embed 'dripyard_base:fieldset' with {
  legend_title: 'Required Information',
  required: true
} %}
  {% block fieldset_content %}
    <div class="form-item">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div class="form-item">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
    </div>
  {% endblock %}
{% endembed %}
```

### Multiple Form Elements
```twig
{% embed 'dripyard_base:fieldset' with {
  legend_title: 'Address Details'
} %}
  {% block fieldset_content %}
    <div class="form-item">
      <label for="street">Street Address</label>
      <input type="text" id="street" name="street">
    </div>
    <div class="form-item">
      <label for="city">City</label>
      <input type="text" id="city" name="city">
    </div>
    <div class="form-item">
      <label for="state">State</label>
      <select id="state" name="state">
        <option value="">Select a state</option>
        <option value="CA">California</option>
        <option value="NY">New York</option>
      </select>
    </div>
  {% endblock %}
{% endembed %}
```
