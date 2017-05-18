<?php

namespace Drupal\schema_breadcrumb\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'schema_breadcrumb_type' meta tag.
 *
 * @MetatagTag(
 *   id = "schema_breadcrumb_type",
 *   label = @Translation("Type"),
 *   description = @Translation("The type of breadcrumb."),
 *   name = "@type",
 *   group = "schema_breadcrumb_list",
 *   weight = -1,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaBreadcrumbType extends SchemaNameBase {
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
        'BreadcrumbList' => $this->t('BreadcrumbList'),
      ],
      '#default_value' => $this->value(),
   ];
    return $form;
  }
}
