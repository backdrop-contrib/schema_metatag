<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

/**
 * Schema.org Geo items should extend this class.
 */
abstract class SchemaGeoBase extends SchemaNameBase {

  /**
   * SchemaGeoTrait provides geo_form().
   */
  use SchemaGeoTrait;

  /**
   * Generate a form element for this meta tag.
   *
   * We need multiple values, so create a tree of values and
   * stored the serialized value as a string.
   */
  public function form(array $element = []) {

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => $this->unserialize($this->value()),
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->getPluginId() . '[@type]',
    ];

    $form = $this->geo_form($input_values);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function output() {
    $element = parent::output();
    if (!empty($element)) {
      $content = $this->unserialize($this->value());
      // If there is no value, don't create a tag.
      $keys = $this->geo_form_keys();
      $empty = TRUE;
      foreach ($keys as $key) {
        if (!empty($content[$key])) {
          $empty = FALSE;
          break;
        }
      }
      if ($empty) {
        return '';
      }
      $element['#attributes']['group'] = $this->group;
      $element['#attributes']['schema_metatag'] = $this->schemaMetatag();
      $element['#attributes']['content'] = [];
      foreach ($keys as $key) {
        $value = $content[$key];
        if (!empty($value)) {
          $element['#attributes']['content'][$key] = $value;
        }
      }
    }
    return $element;
  }

}
