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
  protected $schemaMetatag;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, array $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->schemaMetatag = TRUE;
  }

  /**
   * Retuns whether or not this meta tag has been enabled.
   *
   * @return bool
   *   TRUE if this meta tag has been enabled, FALSE otherwise.
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
      $element['#attributes']['schema_metatag'] = $this->schemaMetatag();
    }
    return $element;
  }

  /**
   * Whether or not this item uses Schema.org definitions.
   */
  public function schemaMetatag() {
    return $this->schemaMetatag;
  }

  /**
   * The serialized value for the metatag.
   *
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
      if (empty($this->arrayTrim($value))) {
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
      $value = $this->recomputeSerializedLength($value);
      $value = unserialize($value);
    }
    return $value;
  }

  /**
   * Remove empty values from a nested array.
   *
   * If the result is an empty array, the nested array is completely empty.
   */
  public function arrayTrim($input) {
    return is_array($input) ? array_filter($input,
      function (& $value) {
        return $value = $this->arrayTrim($value);
      }
    ) : $input;
  }

  /**
   * Update serialized item length computations.
   *
   * Prevent unserialization error if token replacements are different lengths
   * than the original tokens.
   */
  protected function recomputeSerializedLength($value) {
    $value = preg_replace_callback('!s:(\d+):"(.*?)";!', function ($match) {
      return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
    }, $value);
    return $value;
  }

}
