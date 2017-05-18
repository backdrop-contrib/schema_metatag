<?php

namespace Drupal\schema_article\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaImageBase;

/**
 * Provides a plugin for the 'image' meta tag.
 *
 * @MetatagTag(
 *   id = "schema_article_image",
 *   label = @Translation("Image"),
 *   description = @Translation("The primary image for this item."),
 *   name = "image",
 *   group = "schema_article",
 *   weight = 2,
 *   type = "image",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaArticleImage extends SchemaImageBase {
  // Nothing here yet. Just a placeholder class for a plugin.
}
