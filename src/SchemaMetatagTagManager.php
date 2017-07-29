<?php

namespace Drupal\schema_metatag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;
use Drupal\schema_metatag\SchemaMetatagManager;

/**
 * Class SchemaMetatagManager.
 *
 * @package Drupal\schema_metatag
 */
class SchemaMetatagTagManager implements SchemaMetatagTagManagerInterface {

  /**
   * Constructor.
   */
  public function __construct(SchemaNameBase $plugin) {
    $this->plugin = $plugin;
  }

  /**
   * @inherit
   */
  public function process_item(&$value, $key = 0) {

    // Parse out the image URL, if needed.
    $value = $this->parseImageURLValue($value);

    $value = trim($value);

    // If tag must be secure, convert all http:// to https://.
    if ($this->plugin->secure() && strpos($value, 'http://') !== FALSE) {
      $value = str_replace('http://', 'https://', $value);
    }

    $value = $this->plugin->multiple() ? SchemaMetatagManager::explode($value) : $value;
  }

  /**
   * @inherit
   */
  public function parseImageURLValue($value) {

    // If this contains embedded image tags, extract the image URLs.
    if ($this->plugin->type() === 'image') {
      // If image tag src is relative (starts with /), convert to an absolute
      // link.
      global $base_root;
      if (strpos($value, '<img src="/') !== FALSE) {
        $value = str_replace('<img src="/', '<img src="' . $base_root . '/', $value);
      }

      if (strip_tags($value) != $value) {
        if ($this->plugin->multiple()) {
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
