<?php

/**
 * Schema.org Place items should extend this class.
 */
class SchemaPlaceBase extends SchemaAddressBase {

  /**
   * Traits provide re-usable form elements.
   */
  use SchemaAddressTrait;
  use SchemaGeoTrait;

  /**
   * The top level keys on this form.
   */
  function form_keys() {
    return [
      '@type',
      'name',
      'url',
      'address',
      'geo',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = array()) {

    $value = SchemaMetatagManager::unserialize($this->value());

    // Get the id for the nested @type element.
    $selector = $this->visibilitySelector() . '[@type]';
    $visibility = ['visible' => [
      ":input[name='$selector']" => ['value' => 'Place']]
    ];

    $form['value']['#type'] = 'fieldset';
    $form['value']['#description'] = $this->description();
    $form['value']['#tree'] = TRUE;
    $form['value']['#title'] = $this->label();
    $form['value']['@type'] = [
      '#type' => 'select',
      '#title' => $this->t('@type'),
      '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => [
        'Place' => $this->t('Place'),
      ],
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
    ];

    $form['value']['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('name'),
      '#default_value' => !empty($value['name']) ? $value['name'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The name of the place'),
      '#states' => $visibility,
    ];
    $form['value']['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('url'),
      '#default_value' => !empty($value['url']) ? $value['url'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The url of the place.'),
      '#states' => $visibility,
    ];

    $input_values = [
      'title' => $this->t('Address'),
      'description' => 'The address of the place.',
      'value' => !empty($value['address']) ? $value['address'] : [],
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->visibilitySelector() . '[address][@type]',
    ];

    $form['value']['address'] = $this->postal_address_form($input_values);
    $form['value']['address']['#states'] = $visibility;

    $input_values = [
      'title' => $this->t('GeoCoordinates'),
      'description' => 'The geo coordinates of the place.',
      'value' => !empty($value['geo']) ? $value['geo'] : [],
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->visibilitySelector() . '[geo][@type]',
    ];

    $form['value']['geo'] = $this->geo_form($input_values);
    $form['value']['geo']['#states'] = $visibility;

    // This form never got processed by parent::getForm(), so add callback.
    $form['value']['#element_validate'][] = 'schema_metatag_element_validate';

    return $form;
  }

}
