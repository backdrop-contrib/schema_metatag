<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Schema.org Person/Org items should extend this class.
 */
abstract class SchemaPersonOrgBase extends SchemaNameBase {

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
    $form['#open'] = !empty($value['name']);
    $form['#tree'] = TRUE;
    $form['#title'] = $this->label();
    $form['type'] = [
      '#type' => 'select',
      '#title' => $this->t('Type'),
      '#default_value' => !empty($value['type']) ? $value['type'] : '',
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => [
        'Person' => $this->t('Person'),
        'Organization' => $this->t('Organization')
      ],
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#default_value' => !empty($value['name']) ? $value['name'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t(" Name of the person or organization."),
      '#attributes' => ['placeholder' => '[node:author:display-name]'],
    ];

    $form['sameAs'] = [
      '#type' => 'textfield',
      '#title' => $this->t('sameAs'),
      '#default_value' => !empty($value['sameAs']) ? $value['sameAs'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t("Absolute URL of a reference Web page, like the URL of the author's profile page or the organization's official website."),
      '#attributes' => ['placeholder' => '[node:author:url]'],
    ];

    $form['logo'] = [
      '#type' => 'details',
      '#title' => $this->t('Logo'),
      '#description' => $this->t('Organization only. For AMP pages, Google requires a logo no larger than 600 x 60.'),
      '#open' => !empty($value['logo']['url']),
    ];

    $form['logo']['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Url'),
      '#default_value' => !empty($value['logo']['url']) ? $value['logo']['url'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('Absolute URL of the logo.'),
    ];
    $form['logo']['width'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Width'),
      '#default_value' => !empty($value['logo']['width']) ? $value['logo']['width'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
    ];
    $form['logo']['height'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Height'),
      '#default_value' => !empty($value['logo']['height']) ? $value['logo']['height'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
    ];

    return $form;
  }

  public function output() {
    $element = parent::output();
    if (!empty($element)) {
      $content = $this->unserialize($this->value());

      // If there is no value, don't create a tag.
      if (empty($content['name']) && empty($content['sameAs'])) {
        return '';
      }
      $element['#attributes']['group'] = $this->group;
      $element['#attributes']['schema_metatag'] = $this->schema_metatag();
      $element['#attributes']['content'] = [
        '@type' => $content['type'],
        'name' => $content['name'],
        'sameAs' => $content['sameAs'],
      ];
      if (!empty($content['logo']['url'])) {
        $element['#attributes']['content']['logo'] = [
          '@type' => 'ImageObject',
          'url' => $content['logo']['url'],
          'width' => $content['logo']['width'],
          'height' => $content['logo']['height'],
        ];
      }
    }
    return $element;
  }
}
