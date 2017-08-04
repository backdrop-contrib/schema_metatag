<?php
/**
 * @file
 * Metatag integration for the schema_web_site module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_web_site_metatag_info() {
  $info['groups']['schema_web_site'] = array(
    'label' => t('Schema.org: WebSite'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/WebSite')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_web_site',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_web_site.@type'] = array(
    'label' => t('@type'),
    'description' => t('The type of web site.'),
    'form' => array(
      '#type' => 'select',
      '#options' => _schema_web_site_type_options(),
      '#empty_option' => t('- None -'),
    ),
    'dependencies' => [],
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['schema_web_site.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['schema_web_site.name'] = array(
    'label' => t('name'),
    'description' => t('The name of the web site.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[site:name]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['schema_web_site.url'] = array(
    'label' => t('url'),
    'description' => t('The url of the web site.'),
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[site:url]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['schema_web_site.sameAs'] = array(
    'label' => t('sameAs'),
    'description' => t('Url linked to the web site, such as wikipedia page or social profiles.'),
    'multiple' => TRUE,
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[site:url]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;
  $info['tags']['schema_web_site.publisher'] = array(
    'class' => 'SchemaPeopleOrgBase',
    'label' => t('publisher'),
    'description' => t('The publisher of the web site.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}

/**
 * List the Article 'type' options.
 */
function _schema_web_site_type_options() {
  $options = array(
    'WebSite',
  );
  return drupal_map_assoc($options);
}
