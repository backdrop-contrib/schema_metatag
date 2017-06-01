<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

/**
 * Schema.org PostalAddress items should extend this class.
 */
abstract class SchemaAddressBase extends SchemaNameBase {

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
    $form['@type'] = [
      '#type' => 'select',
      '#title' => $this->t('@type'),
      '#default_value' => !empty($value['@type']) ? $value['@type'] : '',
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => [
        'PostalAddress' => $this->t('PostalAddress'),
      ],
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
    ];

    $form['streetAddress'] = [
      '#type' => 'textfield',
      '#title' => $this->t('streetAddress'),
      '#default_value' => !empty($value['streetAddress']) ? $value['streetAddress'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t("The street address. For example, 1600 Amphitheatre Pkwy."),
    ];

    $form['addressLocality'] = [
      '#type' => 'textfield',
      '#title' => $this->t('addressLocality'),
      '#default_value' => !empty($value['addressLocality']) ? $value['addressLocality'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t("The locality. For example, Mountain View."),
    ];

    $form['addressRegion'] = [
      '#type' => 'textfield',
      '#title' => $this->t('addressRegion'),
      '#default_value' => !empty($value['addressRegion']) ? $value['addressRegion'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t("The region. For example, CA."),
    ];

    $form['postalCode'] = [
      '#type' => 'textfield',
      '#title' => $this->t('postalCode'),
      '#default_value' => !empty($value['postalCode']) ? $value['postalCode'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The postal code. For example, 94043.'),
    ];
    $form['addressCountry'] = [
      '#type' => 'textfield',
      '#title' => $this->t('addressCountry'),
      '#default_value' => !empty($value['addressCountry']) ? $value['addressCountry'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The country. For example, USA. You can also provide the two-letter ISO 3166-1 alpha-2 country code.'),
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
      $keys = [
        '@type',
        'streetAddress',
        'addressLocality',
        'addressRegion',
        'postalCode',
        'addressCountry',
      ];
      $empty = TRUE;
      foreach ($keys as $key) {
        if (!empty($content[$key])) {
          $empty = FALSE;
          break;
        }
      }
      if ($empty) {
        return '';
      }
      $element['#attributes']['group'] = $this->group;
      $element['#attributes']['schema_metatag'] = $this->schemaMetatag();
      $element['#attributes']['content'] = [];
      foreach ($keys as $key) {
        $value = $content[$key];
        if (!empty($value)) {
          $element['#attributes']['content'][$key] = $value;
        }
      }
    }
    return $element;
  }

}
