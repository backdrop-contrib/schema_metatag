<?php

/**
 * Schema.org Place items should extend this class.
 */
class SchemaPlaceBase extends SchemaAddressBase {

  use SchemaAddressTrait;
  use SchemaGeoTrait;

  /**
   * The top level keys on this form.
   */
  public static function formKeys() {
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
  public function getForm(array $options = []) {

    $input_values = SchemaMetatagManager::defaultInputValues();
    $value = SchemaMetatagManager::unserialize($this->value());

    // Get the id for the nested @type element.
    $selector = $this->visibilitySelector();
    $visibility = ['visible' => [':input[name="' . $selector . '[@type]"]' => ['value' => 'Place']]];

    $form['value']['#type'] = 'fieldset';
    $form['value']['#description'] = $this->description();
    $form['value']['#open'] = !empty($value['name']);
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
    ];
    $form['value']['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('url'),
      '#default_value' => !empty($value['url']) ? $value['url'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The url of the place.'),
    ];

    $input_values = [
      'title' => $this->t('Address'),
      'description' => 'The address of the place.',
      'value' => !empty($value['address']) ? $value['address'] : [],
      '#required' => $input_values['#required'],
      'visibility_selector' => $selector . '[address][@type]',
    ];

    $form['value']['address'] = $this->postalAddressForm($input_values);
    $form['value']['address']['#states'] = $visibility;

    $input_values = [
      'title' => $this->t('GeoCoordinates'),
      'description' => 'The geo coordinates of the place.',
      'value' => !empty($value['geo']) ? $value['geo'] : [],
      '#required' => $input_values['#required'],
      'visibility_selector' => $selector . '[geo][@type]',
    ];

    $form['value']['geo'] = $this->geoForm($input_values);
    $form['value']['geo']['#states'] = $visibility;

    // Validation from parent::getForm() got wiped out, so add callback.
    $form['value']['#element_validate'][] = 'schema_metatag_element_validate';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    $items = [];
    $keys = self::formKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case 'address':
          $items[$key] = SchemaAddressBase::testValue();
          break;

        case 'geo':
          $items[$key] = SchemaGeoBase::testValue();
          break;

        case '@type':
          $items[$key] = 'Place';
          break;

        default:
          $items[$key] = parent::testDefaultValue(2, ' ');
          break;

      }
    }
    return $items;
  }

}
