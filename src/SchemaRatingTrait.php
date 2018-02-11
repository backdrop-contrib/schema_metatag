<?php

/**
 * Schema.org Rating trait.
 */
trait SchemaRatingTrait {

  /**
   * Form keys.
   */
  public static function ratingFormKeys() {
    return [
      '@type',
      'ratingValue',
      'bestRating',
      'worstRating',
      'ratingCount',
    ];
  }

  /**
   * Input values.
   */
  public function ratingInputValues() {
    return [
      'title' => '',
      'description' => '',
      'value' => [],
      '#required' => FALSE,
      'visibility_selector' => '',
    ];
  }

  /**
   * The form element.
   */
  public function ratingForm($input_values) {

    $input_values += $this->ratingInputValues();
    $value = $input_values['value'];

    // Get the id for the nested @type element.
    $selector = ':input[name=' . $this->visibilitySelector() . '[@type]]';
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
        'Rating' => $this->t('Rating'),
        'AggregateRating' => $this->t('AggregateRating'),
      ],
      '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
    ];

    $form['ratingValue'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ratingValue'),
      '#default_value' => !empty($value['ratingValue']) ? $value['ratingValue'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The numeric rating of the item.'),
    ];

    $form['ratingCount'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ratingCount'),
      '#default_value' => !empty($value['ratingCount']) ? $value['ratingCount'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The number of ratings included. Only required for AggregateRating.'),
    ];

    $form['bestRating'] = [
      '#type' => 'textfield',
      '#title' => $this->t('bestRating'),
      '#default_value' => !empty($value['bestRating']) ? $value['bestRating'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The highest rating value possible.'),
    ];

    $form['worstRating'] = [
      '#type' => 'textfield',
      '#title' => $this->t('worstRating'),
      '#default_value' => !empty($value['worstRating']) ? $value['worstRating'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The lowest rating value possible.'),
    ];

    $keys = self::ratingFormKeys();
    foreach ($keys as $key) {
      if ($key != '@type') {
        $form[$key]['#states'] = $visibility;
      }
    }

    return $form;
  }

}
