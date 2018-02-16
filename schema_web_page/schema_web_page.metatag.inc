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
    'class' => 'SchemaWebPageType',
    'label' => t('@type'),
    'description' => t('The type of web page.'),
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
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.url'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('url'),
    'description' => t('The url of the web page.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.hasPart'] = array(
    'class' => 'SchemaHasPartBase',
    'label' => t('hasPart'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.isAccessibleForFree'] = array(
    'class' => 'SchemaIsAccessibleForFreeBase',
    'label' => t('isAccessibleForFree'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_web_page.listElementBreadcrumb'] = array(
    'class' => 'SchemaListElementBreadcrumbBase',
    'label' => t('breadcrumb'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
