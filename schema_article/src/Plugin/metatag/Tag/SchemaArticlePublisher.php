<?php

namespace Drupal\schema_article\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaPersonOrgBase;

/**
 * Provides a plugin for the 'publisher' meta tag.
 *
 * @MetatagTag(
 *   id = "schema_article_publisher",
 *   label = @Translation("Publisher"),
 *   description = @Translation("Publisher of the article."),
 *   name = "publisher",
 *   group = "schema_article",
 *   weight = 6,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaArticlePublisher extends SchemaPersonOrgBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function form(array $element = []) {
    $form = parent::form($element);
    $form['name']['#attributes']['placeholder'] = '[site:name]';
    $form['sameAs']['#attributes']['placeholder'] = '[site:url]';
    return $form;
  }
}
