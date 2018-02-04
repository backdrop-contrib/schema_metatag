<?php
/**
 * @file
 * Metatag integration for the schema_article module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_article_metatag_info() {
  $info['groups']['schema_article'] = array(
    'label' => t('Schema.org: Article'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/Article')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_article',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_article.@type'] = array(
    'class' => 'SchemaArticleType',
    'label' => t('@type'),
    'description' => t('The type of article.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.headline'] = array(
    'label' => t('headline'),
    'description' => t('Headline of the article.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.name'] = array(
    'label' => t('name'),
    'description' => t('Name of the article.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.author'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('author'),
    'description' => t('Author of the article.'),
    'multiple' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.publisher'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('publisher'),
    'description' => t('Publisher of the article.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.datePublished'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('datePublished'),
    'description' => t('Date the article was published.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.dateModified'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('dateModified'),
    'description' => t('Date the article was last modified.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.about'] = array(
    'label' => t('about'),
    'description' => t('Comma separated list of what the article is about, for instance taxonomy terms or categories.'),
    'multiple' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:field_tags]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('The primary image for this item.'),
    'image' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.mainEntityOfPage'] = array(
    'class' => 'SchemaMainEntityOfPageBase',
    'label' => t('mainEntityOfPage'),
    'description' => t(''),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.hasPart'] = array(
    'class' => 'SchemaHasPartBase',
    'label' => t('hasPart'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.isAccessibleForFree'] = array(
    'class' => 'SchemaIsAccessibleForFreeBase',
    'label' => t('isAccessibleForFree'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.aggregateRating'] = array(
    'class' => 'SchemaAggregateRatingBase',
    'label' => t('aggregateRating'),
    'description' => t(''),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;

}
