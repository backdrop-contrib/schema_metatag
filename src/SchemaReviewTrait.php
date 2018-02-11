<?php

/**
 * Schema.org Review trait.
 */
trait SchemaReviewTrait {

  use SchemaRatingTrait;
  use SchemaPersonOrgTrait;

  /**
   * Form keys.
   */
  public static function reviewFormKeys() {
    return [
      '@type',
      'reviewBody',
      'datePublished',
      'author',
      'reviewRating',
    ];
  }

  /**
   * Input values.
   */
  public function reviewInputValues() {
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
  public function reviewForm($input_values) {

    $input_values += $this->reviewInputValues();
    $value = $input_values['value'];

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
        'Review' => $this->t('Review'),
        'UserReview' => $this->t('- UserReview'),
        'CriticReview' => $this->t('- CriticReview'),
        'EmployerReview' => $this->t('- EmployerReview'),
        'ClaimReview' => $this->t('ClaimReview'),
      ],
      '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
    ];

    $form['reviewBody'] = [
      '#type' => 'textfield',
      '#title' => $this->t('reviewBody'),
      '#default_value' => !empty($value['reviewBody']) ? $value['reviewBody'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('The actual body of the review.'),
    ];

    $form['datePublished'] = [
      '#type' => 'textfield',
      '#title' => $this->t('datePublished'),
      '#default_value' => !empty($value['datePublished']) ? $value['datePublished'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('To format the date properly, use a token like [node:created:custom:Y-m-d\TH:i:sO].'),
    ];

    $input_values = [
      'title' => $this->t('author'),
      'description' => 'The author of this review.',
      'value' => !empty($value['author']) ? $value['author'] : [],
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->getPluginId() . '[author][@type]',
    ];
    $form['author'] = $this->personOrgForm($input_values);

    // Add #states to show/hide the fields based on the value of @type,
    // if a selector was provided.
    if (!empty($input_values['visibility_selector'])) {
      $selector = ':input[name="' . $input_values['visibility_selector'] . '"]';
      $visibility = ['invisible' => [$selector => ['value' => '']]];
      $keys = static::reviewFormKeys();
      foreach ($keys as $key) {
        if ($key != '@type') {
          $form[$key]['#states'] = $visibility;
        }
      }
    }

    $input_values = [
      'title' => $this->t('reviewRating'),
      'description' => 'The rating of this review.',
      'value' => !empty($value['reviewRating']) ? $value['reviewRating'] : [],
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->getPluginId() . '[reviewRating][@type]',
    ];
    $form['reviewRating'] = $this->ratingForm($input_values);

    return $form;
  }

}
