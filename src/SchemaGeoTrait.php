<?php

/**
 * Schema.org Geo trait.
 */
trait SchemaGeoTrait {

  /**
   * Form keys.
   */
  public static function geoFormKeys() {
    return [
      '@type',
      'latitude',
      'longitude',
    ];
  }

  /**
   * The form element.
   */
  public function geoForm($input_values) {

    $input_values += SchemaMetatagManager::defaultInputValues();
    $value = $input_values['value'];

    // Get the id for the nested @type element.
    $selector = ':input[name="' . $this->visibilitySelector() . '[@type]"]';
    $visibility = ['invisible' => [$selector => ['value' => '']]];

    $form['#type'] = 'fieldset';
    $form['#title'] = $input_values['title'];
    $form['#description'] = $input_values['description'];
    $form['#tree'] = TRUE;

    $form['@type'] = [
      '#type' => 'select',
      '#title' => $this->t('@type'),
      '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => [
        'GeoCoordinates' => $this->t('GeoCoordinates'),
      ],
      '#required' => $input_values['#required'],
    ];

    $form['latitude'] = [
      '#type' => 'textfield',
      '#title' => $this->t('latitude'),
      '#default_value' => !empty($value['latitude']) ? $value['latitude'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t("The latitude of a location. For example 37.42242 (WGS 84)."),
    ];

    $form['longitude'] = [
      '#type' => 'textfield',
      '#title' => $this->t('longitude'),
      '#default_value' => !empty($value['longitude']) ? $value['longitude'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t("The longitude of a location. For example -122.08585 (WGS 84)."),
    ];

    $keys = static::geoFormKeys();
    foreach ($keys as $key) {
      if ($key != '@type') {
        $form[$key]['#states'] = $visibility;
      }
    }

    return $form;
  }

}
