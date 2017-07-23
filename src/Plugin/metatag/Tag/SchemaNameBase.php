<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use \Drupal\metatag\Plugin\metatag\Tag\MetaNameBase;

/**
 * All Schema.org tags should extend this class.
 */
abstract class SchemaNameBase extends MetaNameBase {

  /**
   * Add group info and identify tags that use the schema.org definitions.
   */
  public function output() {
    $value = $this->unserialize($this->value());
    if (empty($value)) {
      return '';
    }
    // If this is a complex array of value, process the array.
    elseif (is_array($value)) {

      // Clean out empty values.
      $value = array_filter($value);

      // If the item is an array of values,
      // walk the array and process the values.
      array_walk_recursive($value, 'self::process_item');

      // See if any nested items need to be pivoted.
      // If pivot is set to 0, it would have been removed as an empty value.
      if (array_key_exists('pivot', $value)) {
        unset($value['pivot']);
        $value = $this->pivot($value);
      }

    }
    // Process a simple string.
    else {
      $this->process_item($value);
    }
    $output = [
      '#tag' => 'meta',
      '#attributes' => [
        'name' => $this->name,
        'content' => $value,
        'group' => $this->group,
        'schema_metatag' => $this->schemaMetatag(),
      ]
    ];
    return $output;
  }

  /**
   * Process an individual item.
   *
   * This is a copy of the original processing done by Metatag module,
   * but applied to every item on the array of values.
   */
  public function process_item(&$value, $key = 0) {

    // Parse out the image URL, if needed.
    $value = $this->parseImageURLValue($value);

    $value = trim($value);

    // If tag must be secure, convert all http:// to https://.
    if ($this->secure() && strpos($value, 'http://') !== FALSE) {
      $value = str_replace('http://', 'https://', $value);
    }

    $value = $this->explode($value);
  }

  /**
   * Complex serialized value that might contain multiple
   * values. In this case we have to pivot the results.
   */
  public function pivot($content) {
    $count = max(array_map('count', $content));
    $pivoted = [];
    for ($i=0; $i<$count; $i++) {
      foreach ($content as $key => $item) {
        // Some properties, like @type, may need to repeat the first item,
        // others may have too few values to fill out the array.
        // Make sure all properties have the right number of values.
        if (is_string($item) || count($item) < $count) {
          $content[$key] = [];
          for ($x=0; $x<$count; $x++) {
            $content[$key][$x] = $item;
          }
        }
        $pivoted[$i][$key] = $content[$key][$i];
      }
    }
    return $pivoted;
  }

  /**
   * Whether or not this item uses Schema.org definitions.
   */
  public function schemaMetatag() {
    return TRUE;
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
   * Wrapper for serialize to prevent errors.
   */
  protected function serialize($value) {
    // Make sure the same value isn't serialized more than once if this is
    // called multiple times.
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
   * Wrapper for unserialize to prevent errors.
   */
  protected function unserialize($value) {
    // Make sure the the value is not just a plain string and that
    // the same value isn't unserialized more than once if this is called
    // multiple times.
    if ($this->isSerialized($value)) {
      // Fix problems created if token replacements are a different size
      // than the original tokens.
      $value = $this->recomputeSerializedLength($value);
      $value = unserialize($value);
    }
    return $value;
  }

  /**
   * Check if a value looks like a serialized array.
   */
  function isSerialized($value) {
    // if it isn't a string, it isn't serialized
    if (!is_string($value)) return false;
    $data = trim($value);
    if ('N;' == $value) return true;
    if (!preg_match('/^([adObis]):/', $value, $badions)) {
      return false;
    }
    switch ($badions[1]) {
      case 'a':
      case 'O':
      case 's':
        if (preg_match("/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $value))
          return true;
        break;
      case 'b':
      case 'i':
      case 'd':
        if (preg_match("/^{$badions[1]}:[0-9.E-]+;\$/", $value))
          return true;
        break;
    }
    return false;
  }

  /**
   * Explode values if this is a multiple value field.
   */
  public function explode($value) {
    if ($this->multiple()) {
      $exploded = array_filter(explode(',', $value));
      if (count($exploded) == 1) {
        $value = $exploded[0];
      }
      else {
        $value = $exploded;
      }
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


  /**
   * A copy of Metatag's parseImageUrl that does not assume $value
   * is always $this->value().
   */
  protected function parseImageURLValue($value) {

    // If this contains embedded image tags, extract the image URLs.
    if ($this->type() === 'image') {
      // If image tag src is relative (starts with /), convert to an absolute
      // link.
      global $base_root;
      if (strpos($value, '<img src="/') !== FALSE) {
        $value = str_replace('<img src="/', '<img src="' . $base_root . '/', $value);
      }

      if (strip_tags($value) != $value) {
        if ($this->multiple()) {
          $values = explode(',', $value);
        }
        else {
          $values = [$value];
        }

        // Check through the value(s) to see if there are any image tags.
        foreach ($values as $key => $val) {
          $matches = [];
          preg_match('/src="([^"]*)"/', $val, $matches);
          if (!empty($matches[1])) {
            $values[$key] = $matches[1];
          }
        }
        $value = implode(',', $values);

        // Remove any HTML tags that might remain.
        $value = strip_tags($value);
      }
    }

    return $value;
  }
}
