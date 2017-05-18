<?php

namespace Drupal\schema_article\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'schema_article_description' meta tag.
 *
 * @MetatagTag(
 *   id = "schema_article_type",
 *   label = @Translation("Type"),
 *   description = @Translation("The type of article."),
 *   name = "@type",
 *   group = "schema_article",
 *   weight = -1,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaArticleType extends SchemaNameBase {
  /**
   * Generate a form element for this meta tag.
   */
  public function form(array $element = []) {
    $form = [
      '#type' => 'select',
      '#title' => $this->t('Type'),
      '#title' => $this->label(),
      '#description' => $this->description(),
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => [
        'Article' => $this->t('Article'),
        'NewsArticle' => $this->t('NewsArticle'),
        'BlogPosting' => $this->t('BlogPosting'),
        'SocialMediaPosting' => $this->t('SocialMediaPosting'),
        'Report' => $this->t('Report'),
        'ScholarlyArticle' => $this->t('ScholarlyArticle'),
        'TechArticle' => $this->t('TechArticle'),
        'APIReference' => $this->t('APIReference'),
      ],
      '#default_value' => $this->value(),
   ];
    return $form;
  }
}
