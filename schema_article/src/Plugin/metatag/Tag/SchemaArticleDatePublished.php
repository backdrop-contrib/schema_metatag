<?php

namespace Drupal\schema_article\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaDateBase;

/**
 * Provides a plugin for the 'datePublished' meta tag.
 *
 * @MetatagTag(
 *   id = "schema_article_date_published",
 *   label = @Translation("Date Published"),
 *   description = @Translation("Date the article was published."),
 *   name = "datePublished",
 *   group = "schema_article",
 *   weight = 3,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaArticleDatePublished extends SchemaDateBase {
  /**
   * Generate a form element for this meta tag.
   */
  public function form(array $element = []) {
    $form = parent::form($element);
    $form['#attributes']['placeholder'] = '[node:created:html_datetime]';
    return $form;
  }
}
