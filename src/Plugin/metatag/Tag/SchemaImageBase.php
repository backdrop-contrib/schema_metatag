<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

/**
 * Schema.org Image items should extend this class.
 */
abstract class SchemaImageBase extends SchemaNameBase {

  /**
   * Traits provide re-usable form elements.
   */
  use SchemaImageTrait;

  /**
   * Generate a form element for this meta tag.
   *
   * We need multiple values, so create a tree of values and
   * stored the serialized value as a string.
   */
  public function form(array $element = []) {

    $value = $this->unserialize($this->value());

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => $this->unserialize($this->value()),
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->getPluginId() . '[@type]',
    ];

    $form = $this->image_form($input_values);

    return $form;
  }

}
