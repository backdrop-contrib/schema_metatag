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
   * {@inheritdoc}
   */
  public function getForm(array $options = array()) {
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

    // Validation from parent::getForm() got wiped out, so add callback.
    $form['value']['#element_validate'][] = 'schema_metatag_element_validate';

    if (!empty($this->info['multiple'])) {
      $form['value']['pivot'] = $this->pivot_form($value);
      $form['value']['pivot']['#states'] = ['invisible' => [
        ':input[name="' . $input_values['visibility_selector'] . '"]' => [
			    'value' => '']
        ]
      ];
    }

    return $form;
  }

}
