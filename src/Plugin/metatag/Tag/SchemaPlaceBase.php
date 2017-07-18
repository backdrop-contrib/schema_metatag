<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaAddressBase;

/**
 * Schema.org Place items should extend this class.
 */
abstract class SchemaPlaceBase extends SchemaAddressBase {

  /**
   * Generate a form element for this meta tag.
   *
   * We need multiple values, so create a tree of values and
   * stored the serialized value as a string.
   */

  public function form(array $element = []) {

    $value = $this->unserialize($this->value());

    $form['#type'] = 'fieldset';
    $form['#description'] = $this->description();
    $form['#open'] = !empty($value['name']);
    $form['#tree'] = TRUE;
    $form['#title'] = $this->label();
    $form['@type'] = [
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

    // Get the id for the nested @type element.
    $selector = $this->getPluginId() . '[@type]';
    $place_visibility = ['visible' => [
      ":input[name='$selector']" => ['value' => 'Place']]
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('name'),
      '#default_value' => !empty($value['name']) ? $value['name'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The name of the place'),
      '#states' => $place_visibility,
    ];
    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('url'),
      '#default_value' => !empty($value['url']) ? $value['url'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The url of the place.'),
      '#states' => $place_visibility,
    ];

    $form['address'] = parent::form($element);
    $form['address']['#title'] = $this->t('Address');

    // Update values and #states on the nested address form.
    $selector = $this->getPluginId() . '[address][@type]';
    $postal_address_visibility = ['visible' => [
      ":input[name='$selector']" => ['value' => 'PostalAddress']]
    ];

    $keys = parent::form_keys();
    foreach ($keys as $key) {
      $form['address'][$key]['#default_value'] = !empty($value['address'][$key]) ? $value['address'][$key] : '';
      $form['address'][$key]['#states'] = $postal_address_visibility;
    }
    return $form;
  }


  function form_keys() {
    return [
      '@type',
      'name',
      'url',
      'address',
    ];
  }
}
