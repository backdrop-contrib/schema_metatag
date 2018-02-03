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
    'label' => t('@type'),
    'description' => t('The type of product (fixed by standard).'),
    'form' => array(
      '#type' => 'select',
      '#options' => array(
        'Product' => t('Product'),
      ),
      '#empty_option' => t('- None -'),
    ),
    'dependencies' => [],
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.name'] = array(
    'label' => t('name'),
    'description' => t('Name of the product.'),
    'form' => array(
      '#attributes' => array(
        'placeholder' => '[node:title]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the item.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:field_description]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('The primary image for this item.'),
    'image' => TRUE,
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
        'placeholder' => '[image:field_image]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_product.offers'] = array(
    'label' => t('offers'),
    'description' => t('Offers associated with the product.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:field_special_offers]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
