<?php

/**
 * Schema.org Image trait.
 */
trait SchemaImageTrait {

  /**
   * Form keys.
   */
  public static function imageFormKeys() {
    return [
      '@type',
      'representativeOfPage',
      'url',
      'width',
      'height',
    ];
  }

  /**
   * The form element.
   */
  public function imageForm($input_values) {

    $input_values += SchemaMetatagManager::defaultInputValues();
    $value = $input_values['value'];

    // Get the id for the nested @type element.
    $selector = ':input[name="' . $input_values['visibility_selector'] . '[@type]"]';
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
        'ImageObject' => $this->t('ImageObject'),
      ],
      '#required' => $input_values['#required'],
    ];

    $form['representativeOfPage'] = [
      '#type' => 'select',
      '#title' => $this->t('representative Of Page'),
      '#empty_option' => t('False'),
      '#empty_value' => '',
      '#options' => ['True' => 'True'],
      '#default_value' => !empty($value['representativeOfPage']) ? $value['representativeOfPage'] : '',
      '#required' => $input_values['#required'],
      '#description' => $this->t('Whether this image is representative of the content of the page.'),
    ];

    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('url'),
      '#default_value' => !empty($value['url']) ? $value['url'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
      '#description' => $this->t('Absolute URL of the image. If using tokens include the image preset name, and the URL attribute. [node:field_name:image_preset_name:url]. If using referenced entities like Media or Paragraphs, your token would look like [node:field_name:entity:field_name:image_preset_name:url].'),
    ];

    $form['width'] = [
      '#type' => 'textfield',
      '#title' => $this->t('width'),
      '#default_value' => !empty($value['width']) ? $value['width'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
    ];

    $form['height'] = [
      '#type' => 'textfield',
      '#title' => $this->t('height'),
      '#default_value' => !empty($value['height']) ? $value['height'] : '',
      '#maxlength' => 255,
      '#required' => $input_values['#required'],
    ];

    $keys = static::imageFormKeys();
    foreach ($keys as $key) {
      if ($key != '@type') {
        $form[$key]['#states'] = $visibility;
      }
    }

    return $form;
  }

}
