<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use \Drupal\metatag\Plugin\metatag\Tag\MetaNameBase;

/**
 * All Schema.org tags should extend this class.
 */
abstract class SchemaNameBase extends MetaNameBase {

  /**
   * Identifier that this is an item that uses Schema.org definitions.
   */
  protected $schema_metatag;

  public function __construct(array $configuration, $plugin_id, array $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->schema_metatag = TRUE;
  }

  /**
   * @return bool
   *   Whether this meta tag has been enabled.
   */
  public function isActive() {
    if ($this->group == 'schema_group_base') {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * Add group info and identify tags that use the schema.org definitions.
   */
  public function output() {

    $element = parent::output();
    if (!empty($element)) {
      $element['#attributes']['group'] = $this->group;
      $element['#attributes']['schema_metatag'] = $this->schema_metatag();
    }
    return $element;
  }

  public function schema_metatag() {
    return $this->schema_metatag;
  }

  /**
   * Metatag expects a string value, so use the serialized value
   * without unserializing it. Manually unserialize it when needed.
   */
  public function value() {
    return $this->value;
  }

  /**
   * Metatag expects a string value, so serialize any array of values.
   */
  public function setValue($value) {
    $this->value = $this->serialize($value);
  }

  /**
   * Make sure the same value isn't serialized more than once.
   */
  protected function serialize($value) {
    if (is_array($value)) {
      // Don't serialize an empty array.
      // Otherwise Metatag won't know the field is empty.
      if (empty($this->array_trim($value))) {
        return '';
      }
      else {
        $value = serialize($value);
      }
    }
    return $value;
  }

  /**
   * Make sure the same value isn't unserialized more than once.
   */
  protected function unserialize($value) {
    if (!is_array($value)) {
      // Fix problems created if token replacements are a different size
      // than the original tokens.
      $value = $this->recompute_serialized_length($value);
      $value = unserialize($value);
    }
    return $value;
  }

  /**
   * Remove empty values from a nested array.
   *
   * If the result is an empty array, the nested array is completely empty.
   */
  function array_trim($input) {
    return is_array($input) ? array_filter($input,
      function (& $value) { return $value = $this->array_trim($value); }
    ) : $input;
  }

  /**
   * Update serialized item length computations.
   *
   * Prevent unserialization error if token replacements are different lengths
   * than the original tokens.
   */
  protected function recompute_serialized_length($value) {
    $value = preg_replace_callback ( '!s:(\d+):"(.*?)";!', function($match) {
      return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
}, $value);
    return $value;
  }
}
