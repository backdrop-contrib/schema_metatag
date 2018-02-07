<?php
/**
 * @file
 * Metatag integration for the schema_service module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_service_metatag_info() {
  $info['groups']['schema_service'] = array(
    'label' => t('Schema.org: Service'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/Service')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_service',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_service.@type'] = array(
    'class' => 'SchemaServiceType',
    'label' => t('@type'),
    'description' => t('The type of service (fixed by standard).'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_service.name'] = array(
    'label' => t('name'),
    'description' => t('Name of the service.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_service.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_service.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('The primary image for this item.'),
    'image' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_service.offers'] = array(
    'label' => t('offers'),
    'description' => t('Offers associated with the service.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_service.aggregateRating'] = array(
    'class' => 'SchemaAggregateRatingBase',
    'label' => t('aggregateRating'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}