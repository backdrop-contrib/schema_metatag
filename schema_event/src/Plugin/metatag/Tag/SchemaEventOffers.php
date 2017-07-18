<?php

namespace Drupal\schema_event\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'offers' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_event_offers",
 *   label = @Translation("offers"),
 *   description = @Translation("Offers associated with the event."),
 *   name = "offers",
 *   group = "schema_event",
 *   weight = 6,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaEventOffers extends SchemaNameBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function form(array $element = []) {
    $value = $this->unserialize($this->value());

    $form['#type'] = 'details';
    $form['#description'] = $this->description();
    $form['#open'] = !empty($value['@type']);
    $form['#tree'] = TRUE;
    $form['#title'] = $this->label();

    $form['@type'] = [
      '#type' => 'select',
      '#title' => $this->label(),
      '#description' => $this->description(),
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
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The three-letter currency code (e.g. USD) in which the price is displayed.'),
    ];
    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('url'),
      '#default_value' => !empty($value['url']) ? $value['url'] : '',
      '#maxlength' => 255,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      '#description' => $this->t('The URL to the store where the offer can be acquired.'),
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
      if (empty($content['price'])) {
        return '';
      }

      $element['#attributes']['group'] = $this->group;
      $element['#attributes']['schema_metatag'] = $this->schemaMetatag();
      $element['#attributes']['content'] = [];
      foreach ($content as $key => $value) {
        if (!empty($value)) {
          $element['#attributes']['content'][$key] = $value;
        }
      }
    }
    return $element;
  }

}
