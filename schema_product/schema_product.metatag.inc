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
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/Product')),
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
    'description' => t('The type of product (fixed by standard).'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.name'] = array(
    'label' => t('name'),
    'description' => t('Name of the product.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('The primary image for this item.'),
    'image' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.offers'] = array(
    'label' => t('offers'),
    'description' => t('Offers associated with the product.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.rating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('rating'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
