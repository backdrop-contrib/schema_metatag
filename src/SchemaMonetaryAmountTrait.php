<?php

/**
 * Schema.org MonentaryAmount trait.
 */
trait SchemaMonetaryAmountTrait {

  use SchemaPivotTrait;

  /**
   * Return the SchemaMetatagManager.
   *
   * @return \Backdrop\schema_metatag\SchemaMetatagManager
   *   The Schema Metatag Manager service.
   */
  abstract protected function schemaMetatagManager();

  /**
   * Form.
   */
  public function monetaryAmountForm($input_values) {

    $input_values += $this->schemaMetatagManager()->defaultInputValues();
    $value = $input_values['value'];

    // Get the id for the nested @type element.
    $selector = ':input[name="' . $input_values['visibility_selector'] . '[@type]"]';
    $visibility = ['invisible' => [$selector => ['value' => '']]];
    $selector2 = $this->schemaMetatagManager()->altSelector($selector);
    $visibility2 = ['invisible' => [$selector2 => ['value' => '']]];
    $visibility['invisible'] = [$visibility['invisible'], $visibility2['invisible']];

    $form['#type'] = 'fieldset';
    $form['#title'] = $input_values['title'];
    $form['#description'] = $input_values['description'];
    $form['#tree'] = TRUE;

    // Add a pivot option to the form.
    $form['pivot'] = $this->pivotForm($value);
    $form['pivot']['#states'] = $visibility;

    $form['@type'] = [
      '#type' => 'select',
      '#title' => $this->t('@type'),
      '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => [
        'MonetaryAmount' => $this->t('MonetaryAmount'),
      ],
      '#required' => $input_values['#required'],
    ];

    $form['currency'] = [
      '#type' => 'textfield',
      '#title' => $this->t('currency'),
      '#default_value' => !empty($value['currency']) ? $value['currency'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t("The currency in which the monetary amount is expressed. Use 3-letter ISO 4217 format."),
      '#states' => $visibility,
    ];

    $form['value']['#type'] = 'fieldset';
    $form['value']['#title'] = $this->t('QualitativeValue');
    $form['value']['#description'] = $this->t('The numeric value of the amount.');

    $form['value']['@type'] = [
      '#type' => 'select',
      '#title' => $this->t('@type'),
      '#default_value' => !empty($value['value']['@type']) ? $value['value']['@type'] : '',
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => [
        'QuantitativeValue' => $this->t('QuantitativeValue'),
      ],
      '#required' => $input_values['#required'],
      '#description' => $this->t('The type of value.'),
    ];

    $form['value']['value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('value'),
      '#default_value' => !empty($value['value']['value']) ? $value['value']['value'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The value.'),
      '#states' => $visibility,
    ];

    $form['value']['minValue'] = [
      '#type' => 'textfield',
      '#title' => $this->t('minValue'),
      '#default_value' => !empty($value['value']['minValue']) ? $value['value']['minValue'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The minimum value.'),
      '#states' => $visibility,
    ];

    $form['value']['maxValue'] = [
      '#type' => 'textfield',
      '#title' => $this->t('maxValue'),
      '#default_value' => !empty($value['value']['maxValue']) ? $value['value']['maxValue'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The maximum value.'),
      '#states' => $visibility,
    ];

    $form['value']['unitText'] = [
      '#type' => 'textfield',
      '#title' => $this->t('unitText'),
      '#default_value' => !empty($value['value']['unitText']) ? $value['value']['unitText'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The type of value. Should be one of HOUR, DAY, WEEK, MONTH, or YEAR.'),
      '#states' => $visibility,
    ];

    return $form;
  }

}
