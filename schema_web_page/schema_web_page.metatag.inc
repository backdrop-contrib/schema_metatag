<?php
/**
 * @file
 * Metatag integration for the schema_web_page module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_web_page_metatag_info() {
  $info['groups']['schema_web_page'] = array(
    'label' => t('Schema.org: WebPage'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/WebPage')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_web_page',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_web_page.@type'] = array(
    'label' => t('@type'),
    'description' => t('The type of web page.'),
    'form' => array(
      '#type' => 'select',
      '#options' => _schema_web_page_type_options(),
      '#empty_option' => t('- None -'),
    ),
    'dependencies' => [],
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['schema_web_page.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['schema_web_page.name'] = array(
    'label' => t('name'),
    'description' => t('The name of the web page.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:title]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['schema_web_page.url'] = array(
    'label' => t('url'),
    'description' => t('The url of the web page.'),
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:url]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}

/**
 * List the Article 'type' options.
 */
function _schema_web_page_type_options() {
  $options = array(
    'WebPage',
    'ItemPage',
    'AboutPage',
    'CheckoutPage',
    'ContactPage',
    'CollectionPage',
    'ProfilePage',
    'SearchResultsPage',
  );
  return drupal_map_assoc($options);
}
