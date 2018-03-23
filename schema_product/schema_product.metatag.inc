<?php

/**
 * @file
 * Metatag integration for the schema_product module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_product_metatag_info() {
  $info['groups']['schema_product'] = array(
    'label' => t('Schema.org: Product'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>, Google\'s recommendations at <a href="!google_url">!google_url</a>.', ['!url' => 'http://schema.org/Product', '!google_url' => 'https://developers.google.com/search/docs/data-types/product']),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_product',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_product.@type'] = array(
    'class' => 'SchemaProductType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of product (fixed by standard).'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.name'] = array(
    'label' => t('name'),
    'description' => t('REQUIRED BY GOOGLE. Name of the product.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.brand'] = array(
    'label' => t('brand'),
    'description' => t('REQUIRED BY GOOGLE. The brand of the product.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.description'] = array(
    'label' => t('description'),
    'description' => t('RECOMMENDED BY GOOGLE. A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('REQUIRED BY GOOGLE. The primary image for this item.'),
    'image' => TRUE,
    'url' => TRUE,
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.offers'] = array(
    'class' => 'SchemaOfferBase',
    'label' => t('offers'),
    'description' => t('RECOMMENDED BY GOOGLE. Offers associated with the product.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.aggregateRating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('aggregateRating'),
    'description' => t('RECOMMENDED BY GOOGLE. Aggregate rating of the product.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => t('RECOMMENDED BY GOOGLE. Review of the product.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
