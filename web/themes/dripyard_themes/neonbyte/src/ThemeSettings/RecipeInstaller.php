<?php

namespace Drupal\neonbyte\ThemeSettings;

use Drupal\dripyard_base\ThemeSettings\RecipeInstaller as RecipeInstallerBase;

class RecipeInstaller extends RecipeInstallerBase {

  /**
   * {@inheritdoc}
   *
   * @return array<string, array<string, mixed>>
   *   Array of available recipes.
   */
  protected function getAvailableRecipes(): array {
    return [
      'dripyard_neonbyte_blocks' => [
        'machine_name' => 'dripyard_neonbyte_blocks',
        'title' => t('Neonbyte Blocks'),
        'description' => t('This recipe provides a set of block types based on the single directory components of this theme. These work well with layout builder, but can be used with other page layout modules.'),
        'extended_by' => ['dripyard_neonbyte_demo_content', 'dripyard_neonbyte_landing_pages'],
      ],
      'dripyard_neonbyte_nodes' => [
        'machine_name' => 'dripyard_neonbyte_nodes',
        'title' => t('Neonbyte Nodes'),
        'description' => t('This recipe provides configurations and view modes for the article node type. These provide examples how how to theme nodes with the theme single directory components.'),
        'extended_by' => ['dripyard_neonbyte_demo_content'],
      ],
      'dripyard_neonbyte_landing_pages' => [
        'machine_name' => 'dripyard_neonbyte_landing_pages',
        'title' => t('Neonbyte Layout Builder Landing Pages'),
        'description' => t('This recipe provides a landing page content type based on layout builder. It will allow you to place the Neonbyte blocks from the recipe above in page layouts.'),
        'extended_by' => ['dripyard_neonbyte_layout_builder_demo'],
      ],
      'dripyard_neonbyte_demo_content' => [
        'machine_name' => 'dripyard_neonbyte_demo_content',
        'title' => t('Neonbyte Demo Content'),
        'description' => t('This recipe provides the demo content for Neonbyte use to build <a href="https://neonbyte.dripyard.com" target="_blank">https://neonbyte.dripyard.com</a> including article nodes, and block content.'),
        'extended_by' => ['dripyard_neonbyte_layout_builder_demo', 'dripyard_neonbyte_canvas_demo'],
      ],
      'dripyard_neonbyte_layout_builder_demo' => [
        'machine_name' => 'dripyard_neonbyte_layout_builder_demo',
        'title' => t('Neonbyte Layout Builder Demo'),
        'description' => t('This recipe provides a <em>Layout Builder</em> based install of <a href="https://neonbyte.dripyard.com" target="_blank">https://neonbyte.dripyard.com</a>. It includes a landing page with various blocks and configurations.<br><strong>This is a content demo and will add entities to your site.</strong>'),
        'extended_by' => [],
      ],
      'dripyard_neonbyte_canvas_demo' => [
        'machine_name' => 'dripyard_neonbyte_canvas_demo',
        'title' => t('Neonbyte Drupal Canvas Demo'),
        'description' => t('This recipe provides a <em>Drupal Canvas</em> based install of <a href="https://neonbyte.dripyard.com" target="_blank">https://neonbyte.dripyard.com</a>. It includes a canvas page with various components and configurations.<br><strong>This is a content demo and will add entities to your site.</strong>'),
        'extended_by' => [],
        'dependencies' => ['canvas'],
      ],
      'dripyard_neonbyte_canvas_patterns' => [
        'machine_name' => 'dripyard_neonbyte_canvas_patterns',
        'title' => t('Neonbyte Drupal Canvas Patterns'),
        'description' => t('This recipe provides component patterns to be used with <em>Drupal Canvas</em>.'),
        'extended_by' => ['dripyard_neonbyte_canvas_demo'],
        'dependencies' => ['canvas'],
      ],
    ];
  }

}
