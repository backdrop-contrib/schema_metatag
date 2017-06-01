<?php

namespace Drupal\schema_metatag;

/**
 * Interface SchemaMetatagManagerInterface.
 *
 * @package Drupal\schema_metatag
 */
interface SchemaMetatagManagerInterface {

  /**
   * Convert a metatags-style data array to JSON LD.
   *
   * Multiple groups can be combined under @graph.
   * All groups that have properties filled out will be presented here.
   */
  public static function jsonld($metatag_data, $route_entity);

  /**
   * Utility function to get a single group.
   */
  public static function groups($group_id);

  /**
   * Utility function to get groups that implement the Schema.org definitions.
   */
  public static function allGroups();

}
