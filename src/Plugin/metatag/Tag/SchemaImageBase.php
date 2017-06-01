<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

/**
 * Schema.org Image items should extend this class.
 */
abstract class SchemaImageBase extends SchemaNameBase {

  /**
   * Generate a form element for this meta tag.
   *
   * We need multiple values, so create a tree of values and
   * stored the serialized value as a string.
   */
  public function form(array $element = []) {

    $value = $this->unserialize($this->value());

    $form['#type'] = 'details';
    $form['#description'] = $this->description();
    $form['#open'] = !empty($value['url']);
    $form['#tree'] = TRUE;
    $form['#title'] = $this->label();

    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('url'),
      '#default_value' => !empty($value['url']) ? $value['url'] : '',
      '#maxlength' => 255,
      '#attributes' => ['placeholder' => '[node:field_image:entity:url]'],
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('Absolute URL of the image, like [node:field_image:entity:url].'),
    ];
    $form['width'] = [
      '#type' => 'textfield',
      '#title' => $this->t('width'),
      '#default_value' => !empty($value['width']) ? $value['width'] : '',
      '#maxlength' => 255,
      '#attributes' => ['placeholder' => '[node:field_image:width]'],
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
    ];
    $form['height'] = [
      '#type' => 'textfield',
      '#title' => $this->t('height'),
      '#default_value' => !empty($value['height']) ? $value['height'] : '',
      '#maxlength' => 255,
      '#attributes' => ['placeholder' => '[node:field_image:height]'],
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function output() {
    $element = parent::output();
    if (!empty($element)) {
      $content = $this->unserialize($this->value());

      // If there is no value, don't create a tag.
      if (empty($content['url'])) {
        return '';
      }
      $element['#attributes']['group'] = $this->group;
      $element['#attributes']['schema_metatag'] = $this->schemaMetatag();
      $element['#attributes']['content'] = [
        '@type' => 'ImageObject',
        'url' => $content['url'],
        'width' => $content['width'],
        'height' => $content['height'],
      ];
    }
    return $element;
  }

}
