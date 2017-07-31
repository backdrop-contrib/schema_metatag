<?php

/**
 * Schema.org Image items should extend this class.
 */
class SchemaImageBase extends SchemaNameBase {

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
 public function getForm(array $options = array()) {
    $value = SchemaMetatagManager::unserialize($this->value());

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => SchemaMetatagManager::unserialize($this->value()),
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->visibilitySelector() . '[@type]',
    ];

    $form = parent::getForm($options);
    $form['value'] = $this->image_form($input_values);
    $form['value']['#element_validate'][] = 'schema_metatag_element_validate';

    return $form;
  }

}
