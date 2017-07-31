<?php

/**
 * Provides a plugin for the 'schema_offer_base' meta tag.
 */
class SchemaOfferBase extends SchemaNameBase {

  /**
   * Traits provide re-usable form elements.
   */
  use SchemaOfferTrait;
  use SchemaPivotTrait;

  /**
   * Generate a form element for this meta tag.
   */
  public getForm(array $options = array()) {
    $value = SchemaMetatagManager::unserialize($this->value());

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => $value,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->visibilitySelector() . '[@type]',
    ];

    $form = parent::getForm($options);
    $form['value'] = $this->offer_form($input_values);

    $form['value']['pivot'] = $this->pivot_form($value);
    $form['value']['pivot']['#states'] = ['invisible' => [
      ':input[name="' . $input_values['visibility_selector'] . '"]' => [
			  'value' => '']
      ]
    ];

    return $form;
  }

}
