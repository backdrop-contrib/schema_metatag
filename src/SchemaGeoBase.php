<?php

/**
 * Schema.org Geo items should extend this class.
 */
class SchemaGeoBase extends SchemaNameBase {

  /**
   * Traits provide re-usable form elements.
   */
  use SchemaGeoTrait;
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
    $form['value'] = $this->geo_form($input_values);

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
