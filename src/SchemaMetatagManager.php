<?php

namespace Drupal\schema_metatag;

/**
 * Class SchemaMetatagManager.
 *
 * @package Drupal\schema_metatag
 */
class SchemaMetatagManager implements SchemaMetatagManagerInterface {

  /**
   * Constructor.
   */
  public function __construct() {

  }

  /**
   * Convert a metatags-style data array to JSON LD.
   *
   * Multiple groups can be combined under @graph.
   * All groups that have properties filled out will be presented here.
   */
  static function jsonld($metatag_data, $route_entity = NULL) {
    $items['@context'] = 'http://schema.org';
    $items['@graph'] = [];
    $group_key = 0;
    foreach ($metatag_data as $group_id => $data) {
      $has_type = FALSE;
      $group = self::groups($group_id);
      if (!empty($group['id'])) {
        foreach ($data as $item) {
          $name = $item[0]['#attributes']['name'];
          $value = $item[0]['#attributes']['content'];
          $items['@graph'][$group_key][$name] = $value;
          if ($name == '@type') {
            $has_type = TRUE;
          }
        }
        $group_key++;
      }
    }
    // If some group has been found, render the JSON LD,
    // otherwise return nothing.
    if ($group_key > 0) {
      return json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
    }
    else {
      return '';
    }
  }

  /**
   * Utility function to get a single group.
   */
  static function groups($group_id = NULL) {
    $filtered_groups = self::all_groups();
    if (!empty($group_id) && array_key_exists($group_id, $filtered_groups)) {
      return $filtered_groups[$group_id];
    }
    if (isset($group_id)) {
      return [];
    }
    return $filtered_groups;
  }

  /**
   * Utility function to get groups that implement the Schema.org definitions.
   *
   * #TODO Add some caching to this operation.
   */
  static function all_groups() {
    $base_groups = ['schema_group_base'];
    $group_manager = \Drupal::service('plugin.manager.metatag.group');
    $groups = $group_manager->getDefinitions();
    $filtered_groups = [];
    foreach ($groups as $key => $group) {
      if (!empty($group['schema_metatag']) && !in_array($key, $base_groups)) {
        $filtered_groups[$key] = $group;
      }
    }
    return $filtered_groups;
  }

}
