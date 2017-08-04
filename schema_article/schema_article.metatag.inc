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
    'label' => t('@type'),
    'description' => t('The type of article.'),
    'form' => array(
      '#type' => 'select',
      '#options' => _schema_article_type_options(),
      '#empty_option' => t('- None -'),
    ),
    'dependencies' => [],
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.headline'] = array(
    'label' => t('headline'),
    'description' => t('Headline of the article.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:title]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the item.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:summary]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.author'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('author'),
    'description' => t('Author of the article.'),
    'multiple' => TRUE,
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:author:name]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.publisher'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('publisher'),
    'description' => t('Publisher of the article.'),
    'url' => TRUE,
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[site:name]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.datePublished'] = array(
    'label' => t('datePublished'),
    'description' => t('Date the article was published.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:created:custom:Y-m-d\TH:i:sO]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.dateModified'] = array(
    'label' => t('dateModified'),
    'description' => t('Date the article was last modified.'),
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:changed:custom:Y-m-d\TH:i:sO]',
      ),
    ),
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
    'form' => array(
      '#attributes' => array(
         'placeholder' => '[node:field_image]',
      ),
    ),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_article.mainEntityOfPage'] = array(
    'label' => t('mainEntityOfPage'),
    'description' => t(''),
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
function _schema_article_type_options() {
  $options = array(
    'Article' => t('Article'),
    'NewsArticle' => t('NewsArticle'),
    'BlogPosting' => t('BlogPosting'),
    'SocialMediaPosting' => t('SocialMediaPosting'),
    'Report' => t('Report'),
    'ScholarlyArticle' => t('ScholarlyArticle'),
    'TechArticle' => t('TechArticle'),
    'APIReference' => t('APIReference'),
  );
  return drupal_map_assoc($options);
}
