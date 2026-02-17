<?php

namespace Drupal\dripyard_base\Layout\Traits;

/**
 * Trait for handling component wrapper functionality in layouts.
 */
trait ComponentWrapperTrait {

  /**
   * Process regions for component wrapper functionality.
   *
   * @param array<string, mixed> $regions
   *   The layout regions.
   * @param array<string, mixed> $build
   *   The current build array.
   *
   * @return array<string, mixed>
   *   The modified build array.
   */
  protected function processComponentWrapper(array $regions, array $build) {
    // Process each region/cell independently
    foreach ($regions as $region_name => $region_content) {
      // Check for dripyard_wrapper in this specific region
      $wrapper_info = $this->findWrapperComponent([$region_name => $region_content]);

      if ($wrapper_info) {
        // Collect content from this region only, excluding the wrapper block
        $content_to_wrap = $this->collectContentForWrapping([$region_name => $region_content], $wrapper_info['wrapper_uuid']);

        if (!empty($content_to_wrap)) {
          // Create the wrapped render array for this region
          $wrapped_content = $this->createWrappedContent($wrapper_info['component'], $content_to_wrap, $wrapper_info['props']);

          // Replace this region's content with the wrapped version
          $build[$region_name] = $wrapped_content;
        }
      }
      else {
        // No wrapper in this region, keep original content
        $build[$region_name] = $region_content;
      }
    }

    return $build;
  }

  /**
   * Find the first dripyard_wrapper component in the regions.
   *
   * @param array<string, mixed> $regions
   *   The layout regions.
   *
   * @return array<string, mixed>|null
   *   Wrapper info array or NULL if not found.
   */
  protected function findWrapperComponent(array $regions) {
    foreach ($regions as $region => $content) {
      if (is_array($content)) {
        foreach ($content as $uuid => $item) {
          if (
            (isset($item['#plugin_id']) && $item['#plugin_id'] === 'inline_block:dripyard_wrapper') ||
            (isset($item['#plugin_id']) && strpos($item['#plugin_id'], 'block_content:') === 0)
            ) {
            // Extract component name and props from the block content
            $block_content = $item['content']['#block_content'] ?? NULL;
            if ($block_content && isset($block_content->dripyard_wrapper)) {
              $field_value = $block_content->dripyard_wrapper->getValue();
              if (!empty($field_value) && isset($field_value[0]['value'])) {
                // Load and parse props from dripyard_wrapper_props
                $props = [];
                if ($block_content->hasField('dripyard_wrapper_props')) {
                  $props_json = $block_content->get('dripyard_wrapper_props')->value;
                  if (!empty($props_json)) {
                    $props = json_decode($props_json, TRUE) ?: [];
                  }
                }

                return [
                  'component' => $field_value[0]['value'],
                  'wrapper_uuid' => $uuid,
                  'region' => $region,
                  'props' => $props,
                ];
              }
            }
          }
        }
      }
    }
    return NULL;
  }

  /**
   * Collect all content except the wrapper block for wrapping.
   *
   * @param array<string, mixed> $regions
   *   The layout regions.
   * @param string $wrapper_uuid
   *   The UUID of the wrapper block to exclude.
   *
   * @return list<mixed>
   *   Array of content items to wrap.
   */
  protected function collectContentForWrapping(array $regions, string $wrapper_uuid): array {
    $content_to_wrap = [];

    foreach ($regions as $content) {
      if (is_array($content)) {
        foreach ($content as $uuid => $item) {
          // Skip the wrapper block itself
          if ($uuid !== $wrapper_uuid) {
            $content_to_wrap[] = $item;
          }
        }
      }
    }

    return $content_to_wrap;
  }

  /**
   * Create the wrapped content using the specified component.
   *
   * @param string $component
   *   The component name (e.g., 'dripyard_base:logo-grid').
   * @param list<mixed> $content_to_wrap
   *   Array of content items to wrap.
   * @param array<string, mixed> $loaded_props
   *   Props loaded from dripyard_wrapper_props.
   *
   * @return array<string, mixed>
   *   The component render array.
   */
  protected function createWrappedContent($component, array $content_to_wrap, array $loaded_props = []) {
    $wrapper_props = $this->getWrapperProps($component, $loaded_props);

    return [
      '#type' => 'component',
      '#component' => $component,
      '#props' => $wrapper_props['props'],
      '#slots' => [
        $wrapper_props['content_slot'] => $content_to_wrap,
      ],
    ];
  }

  /**
   * Get wrapper component properties and slot mapping.
   *
   * @param string $component
   *   The component name.
   * @param array<string, mixed> $loaded_props
   *   Props loaded from dripyard_wrapper_props.
   *
   * @return array<string, mixed>
   *   Array with 'props' and 'content_slot' keys.
   */
  protected function getWrapperProps($component, array $loaded_props = []) {
    // Hard-coded mapping that can be built iteratively
    $wrapper_configs = [
      'dripyard_base:logo-grid' => [
        'props' => [],
        'content_slot' => 'logo_grid_content',
      ],
      'dripyard_base:carousel' => [
        'content_slot' => 'carousel_items',
      ],
      'dripyard_base:tab-group' => [
        'content_slot' => 'tabs',
      ],
      'dripyard_base:accordion-group' => [
        'content_slot' => 'accordion_group_content',
      ],
    ];

    // Get default config for component
    $default_config = $wrapper_configs[$component] ?? [
      'props' => [],
      'content_slot' => 'content',
    ];

    // Merge loaded props with default props
    $merged_props = array_merge($default_config['props'] ?? [], $loaded_props);

    return [
      'props' => $merged_props,
      'content_slot' => $default_config['content_slot'],
    ];
  }

}
