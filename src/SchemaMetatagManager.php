<?php

/**
 * Class SchemaMetatagManager.
 *
 * @package Drupal\schema_metatag
 */
class SchemaMetatagManager implements SchemaMetatagManagerInterface {

  /**
   * {@inheritdoc}
   */
  public static function parseJsonld(&$elements) {
    $schema_metatags = [];
    foreach ($elements as $key => $info) {
      if (!empty($info['#attributes']['schema_metatag'])) {
        // Nest tags by group.
        $group = $info['#attributes']['group'];
        $name = $info['#attributes']['name'];
        $value = $info['#attributes']['content'];
        $schema_metatags[$group][$name] = $value;
        // Remove this tag from the elements array.
        unset($elements[$key]);
      }
    }
    $items = [];
    foreach ($schema_metatags as $data) {
      if (empty($items)) {
        $items['@context'] = 'http://schema.org';
      }
      $items['@graph'][] = $data;
    }
    return $items;
  }

  /**
   * {@inheritdoc}
   */
  public static function encodeJsonld($items) {
    // If some group has been found, render the JSON LD,
    // otherwise return nothing.
    if (!empty($items)) {
      return json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
    }
    else {
      return '';
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function renderArrayJsonLd($jsonld) {
    return [
      '#type' => 'html_tag',
      '#tag' => 'script',
      '#value' => $jsonld,
      '#attributes' => ['type' => 'application/ld+json'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function getRenderedJsonld($entity = NULL, $entity_type = NULL) {
    // If nothing was passed in, assume the current entity.
    // @see schema_metatag_entity_load() to understand why this works.
    if (empty($entity)) {
      $entity_type = $entity->entity_type;
      $entity = menu_get_object($entity_type);
    }
    // Get all the metatags for this entity.
    $elements = metatag_generate_entity_metatags($entity, $entity_type);
    // Parse the Schema.org metatags out of the array.
    if ($items = self::parseJsonld($elements)) {
      // Encode the Schema.org metatags as JSON LD.
      if ($jsonld = self::encodeJsonld($items)) {
          // Pass back the rendered result.
          return drupal_render(self::renderArrayJsonLd($jsonld));
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function pivot($content) {
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
   * {@inheritdoc}
   */
  public static function serialize($value) {
    // Make sure the same value isn't serialized more than once if this is
    // called multiple times.
    if (is_array($value)) {
      // Don't serialize an empty array.
      // Otherwise Metatag won't know the field is empty.
      if (empty(self::arrayTrim($value))) {
        return '';
      }
      else {
        $value = serialize($value);
      }
    }
    return $value;
  }

  /**
   * {@inheritdoc}
   */
  public static function unserialize($value) {
    // Make sure the the value is not just a plain string and that
    // the same value isn't unserialized more than once if this is called
    // multiple times.
    if (self::isSerialized($value)) {
      // Fix problems created if token replacements are a different size
      // than the original tokens.
      $value = self::recomputeSerializedLength($value);
      $value = unserialize($value);
    }
    return $value;
  }

  /**
   * {@inheritdoc}
   */
  public static function isSerialized($value) {
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
   * {@inheritdoc}
   */
  public static function explode($value) {
    $exploded = array_filter(explode(',', $value));
    if (count($exploded) == 1) {
      $value = $exploded[0];
    }
    else {
      $value = $exploded;
    }
    return $value;
  }

  /**
   * {@inheritdoc}
   */
  public static function arrayTrim($input) {
    return is_array($input) ? array_filter($input,
      function (& $value) {
        return $value = self::arrayTrim($value);
      }
    ) : $input;
  }

  /**
   * {@inheritdoc}
   */
  public static function recomputeSerializedLength($value) {
    $value = preg_replace_callback('!s:(\d+):"(.*?)";!', function ($match) {
      return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
    }, $value);
    return $value;
  }

}
