<?php

namespace Drupal\schema_article\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'headline' meta tag.
 *
 * @MetatagTag(
 *   id = "schema_article_headline",
 *   label = @Translation("Headline"),
 *   description = @Translation("Headline of the article."),
 *   name = "headline",
 *   group = "schema_article",
 *   weight = 0,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaArticleHeadline extends SchemaNameBase {
  /**
   * Generate a form element for this meta tag.
   */
  public function form(array $element = []) {
    $form = parent::form($element);
    $form['#attributes']['placeholder'] = '[node:title]';
    return $form;
  }
}
