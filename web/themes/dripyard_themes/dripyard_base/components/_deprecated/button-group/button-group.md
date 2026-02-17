# Button Group Component

⚠️ This component is marked as obsolete. Please replace this with `flex-wrapper` and `button` components.

A container component for grouping multiple button components with automatic primary/secondary styling and flexible layout. **Supports up to 3 buttons maximum.**

## Usage

```twig
{{ include('dripyard_base:button-group', {
  align_x: 'start',
  button_size: 'medium',
  button_1_text: 'Get Started',
  button_1_href: '/get-started',
  button_1_style: 'primary',
  button_2_text: 'Learn More',
  button_2_href: '/learn-more',
  button_2_style: 'default',
  button_2_icon_suffix: 'arrow-right',
  button_3_text: 'Contact Us',
  button_3_href: '/contact'
}, with_context = false) }}
```

### Props

| Property | Type | Options | Required | Description |
|----------|------|---------|----------|-------------|
| `align_x` | string | `start`, `center`, `end` | Yes | Horizontal alignment of button group |
| `button_size` | string | `small`, `medium`, `large` | Yes | Size for all buttons in the group |

#### Button 1 Properties (Required)

| Property | Type | Options | Required | Description |
|----------|------|---------|----------|-------------|
| `button_1_text` | string | - | Yes | Button 1 text content |
| `button_1_href` | string | - | Yes | Button 1 link destination URL |
| `button_1_style` | string | `default`, `primary` | No | Button 1 style variant |
| `button_1_target` | boolean | `true`, `false` | No | Open button 1 link in new window |
| `button_1_icon_prefix` | string | - | No | Icon displayed before button 1 text |
| `button_1_icon_suffix` | string | - | No | Icon displayed after button 1 text |

#### Button 2 Properties (Optional)

| Property | Type | Options | Required | Description |
|----------|------|---------|----------|-------------|
| `button_2_text` | string | - | No | Button 2 text content |
| `button_2_href` | string | - | No | Button 2 link destination URL |
| `button_2_style` | string | `default`, `primary` | No | Button 2 style variant |
| `button_2_target` | boolean | `true`, `false` | No | Open button 2 link in new window |
| `button_2_icon_prefix` | string | - | No | Icon displayed before button 2 text |
| `button_2_icon_suffix` | string | - | No | Icon displayed after button 2 text |

#### Button 3 Properties (Optional)

| Property | Type | Options | Required | Description |
|----------|------|---------|----------|-------------|
| `button_3_text` | string | - | No | Button 3 text content |
| `button_3_href` | string | - | No | Button 3 link destination URL |
| `button_3_style` | string | `default`, `primary` | No | Button 3 style variant |
| `button_3_target` | boolean | `true`, `false` | No | Open button 3 link in new window |
| `button_3_icon_prefix` | string | - | No | Icon displayed before button 3 text |
| `button_3_icon_suffix` | string | - | No | Icon displayed after button 3 text |

## Automatic Styling

The component applies intelligent default styling:

- **First button**: Automatically receives `primary` style if no style is specified
- **Subsequent buttons**: Default to `default` style if no style is specified
- **Override behavior**: Explicit style properties override automatic defaults
