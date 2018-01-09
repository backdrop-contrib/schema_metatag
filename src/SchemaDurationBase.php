<?php

/**
 * Schema.org Duration items should extend this class.
 */
class SchemaDurationBase extends SchemaNameBase {

  /**
   * Process an individual item.
   */
  protected function process_item(&$value, $key = 0) {

    $is_integer = ctype_digit($value) || is_int($value);
    if ($is_integer && $value > 0) {
      $value = 'PT' . $value . 'S';
    }
    parent::process_item($value, $key);
  }
}
