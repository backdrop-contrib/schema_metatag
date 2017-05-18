<?php

namespace Drupal\schema_article_example\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'schema_web_page_type' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_web_page_type",
 *   label = @Translation("Type"),
 *   description = @Translation("The type of web page."),
 *   name = "@type",
 *   group = "schema_web_page",
 *   weight = -1,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaWebPageType extends SchemaNameBase {
  /**
   * Generate a form element for this meta tag.
   */
  public function form(array $element = []) {
    $form = [
      '#type' => 'select',
      '#title' => $this->t('Type'),
      '#title' => $this->label(),
      '#description' => $this->description(),
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => [
        'WebPage' => $this->t('WebPage'),
        'AboutPage' => $this->t('AboutPage'),
        'CheckoutPage' => $this->t('CheckoutPage'),
        'ContactPage' => $this->t('ContactPage'),
        'CollectionPage' => $this->t('CollectionPage'),
        'ProfilePage' => $this->t('ProfilePage'),
        'SearchResultsPage' => $this->t('SearchResultsPage'),
      ],
      '#default_value' => $this->value(),
   ];
    return $form;
  }
}
