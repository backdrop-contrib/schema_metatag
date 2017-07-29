<?php

namespace Drupal\schema_metatag;

/**
 * Interface SchemaMetatagManagerInterface.
 *
 * @package Drupal\schema_metatag
 */
interface SchemaMetatagTagManagerInterface {

  /**
   * Process an individual item.
   *
   * This is a copy of the original processing done by Metatag module,
   * separated out to every item on the array of values.
   */
  public function process_item(&$value, $key = 0);

  /**
   * A copy of Metatag's parseImageUrl that does not assume $value
   * is always $this->value().
   */
  public function parseImageURLValue($value);

}
