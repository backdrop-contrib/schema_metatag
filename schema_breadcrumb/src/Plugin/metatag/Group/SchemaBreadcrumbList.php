<?php

namespace Drupal\schema_breadcrumb\Plugin\metatag\Group;

use \Drupal\schema_metatag\Plugin\metatag\Group\SchemaGroupBase;

/**
 * Provides a plugin for the 'BreadcrumbList' meta tag group.
 *
 * @MetatagGroup(
 *   id = "schema_breadcrumb_list",
 *   label = @Translation("Schema.org: BreadcrumbList"),
 *   description = @Translation("See Schema.org definitions for this Schema type at <a href="":url"">:url</a>.", arguments = { ":url" = "http://schema.org/BreadcrumbList"}),
 *   weight = 0,
 * )
 */
class SchemaBreadcrumbList extends SchemaGroupBase {

}
