<?php

/**
 * @file
 * Metatag integration for the schema_organization module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_organization_metatag_info() {
  $info['groups']['schema_organization'] = array(
    'label' => t('Schema.org: Organization'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/Organization')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_organization',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_organization.@type'] = array(
    'class' => 'SchemaOrganizationType',
    'label' => t('@type'),
    'description' => t('The type of organization.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.name'] = array(
    'label' => t('name'),
    'description' => t('The name of the organization.'),
    'form' => array(
      '#attributes' => array(
        'placeholder' => '[node:title]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.telephone'] = array(
    'label' => t('telephone'),
    'description' => t('The telephone of the web site.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.url'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('url'),
    'description' => t('The url of the organization.'),
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
        'placeholder' => '[site:url]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.sameAs'] = array(
    'class' => 'SchemaUrlBase',
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

  $info['tags']['schema_organization.address'] = array(
    'class' => 'SchemaAddressBase',
    'label' => t('address'),
    'description' => t('The address of the organization.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.geo'] = array(
    'class' => 'SchemaGeoBase',
    'label' => t('geo'),
    'description' => t('The geographic coordinates of the organization.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('The primary image for this item.'),
    'image' => TRUE,
    'url' => TRUE,
    'multiple' => TRUE,
    'form' => array(
      '#attributes' => array(
        'placeholder' => '[node:field_image]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.logo'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('logo'),
    'description' => t('The logo for this organization.'),
    'image' => TRUE,
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
        'placeholder' => '[node:field_image]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.priceRange'] = array(
    'label' => t('priceRange'),
    'description' => t('The price range of products of the organization.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.mainEntityOfPage'] = array(
    'class' => 'SchemaMainEntityOfPageBase',
    'label' => t('mainEntityOfPage'),
    'description' => '',
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.rating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('rating'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;

}
