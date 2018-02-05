<?php

/**
 * Implements hook_metatag_info().
 */
function schema_metatag_test_metatag_info() {
  $info['groups']['testing'] = array(
    'label' => t('Testing'),
    'form' => array(
      '#weight' => 100,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'testing',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_metatag_test.@type'] = array(
    'class' => 'SchemaArticleType',
    'label' => t('@type'),
    'description' => t('The type of article.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.address'] = array(
    'class' => 'SchemaAddressBase',
    'label' => t('address'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.aggregateRating'] = array(
    'class' => 'SchemaAggregateRatingBase',
    'label' => t('aggregateRating'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.date'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('date'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.duration'] = array(
    'class' => 'SchemaDurationBase',
    'label' => t('duration'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.geo'] = array(
    'class' => 'SchemaGeoBase',
    'label' => t('geo'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.hasPart'] = array(
    'class' => 'SchemaHasPartBase',
    'label' => t('hasPart'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t(''),
    'image' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.mainEntityOfPage'] = array(
    'class' => 'SchemaMainEntityOfPageBase',
    'label' => t('mainEntityOfPage'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.name'] = array(
    'class' => 'SchemaNameBase',
    'label' => t('name'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.offer'] = array(
    'class' => 'SchemaOfferBase',
    'label' => t('offer'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.organization'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('organization'),
    'description' => t(''),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.place'] = array(
    'class' => 'SchemaPlaceBase',
    'label' => t('place'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
