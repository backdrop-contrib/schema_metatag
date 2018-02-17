<?php

/**
 * Schema.org Offer trait.
 */
trait SchemaOfferTrait {

  /**
   * Form keys.
   */
  public static function offerFormKeys() {
    return [
      '@type',
      'price',
      'priceCurrency',
      'url',
      'availability',
      'validFrom',
    ];
  }

  /**
   * The form element.
   */
  public function offerForm($input_values) {

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
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => [
        'Offer' => $this->t('Offer'),
      ],
      '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
    ];

    $form['price'] = [
      '#type' => 'textfield',
      '#title' => $this->t('price'),
      '#default_value' => !empty($value['price']) ? $value['price'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The numeric price of the offer.'),
    ];
    $form['priceCurrency'] = [
      '#type' => 'textfield',
      '#title' => $this->t('priceCurrency'),
      '#default_value' => !empty($value['priceCurrency']) ? $value['priceCurrency'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The three-letter currency code (e.g. USD) in which the price is displayed.'),
    ];
    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('url'),
      '#default_value' => !empty($value['url']) ? $value['url'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The URL to the store where the offer can be acquired.'),
    ];
    $form['availability'] = [
      '#type' => 'textfield',
      '#title' => $this->t('availability'),
      '#default_value' => !empty($value['availability']) ? $value['availability'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The availability of this item—for example In stock, Out of stock, Pre-order, etc.'),
    ];
    $form['validFrom'] = [
      '#type' => 'textfield',
      '#title' => $this->t('validFrom'),
      '#default_value' => !empty($value['validFrom']) ? $value['validFrom'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The date when the item becomes valid.'),
    ];

    $keys = static::offerFormKeys();
    foreach ($keys as $key) {
      if ($key != '@type') {
        $form[$key]['#states'] = $visibility;
      }
    }

    return $form;
  }

}
