<?php

namespace Drupal\schema_breadcrumb\Plugin\metatag\Tag;

use \Drupal\schema_metatag\Plugin\metatag\Tag\SchemaNameBase;

/**
 * Provides a plugin for the 'schema_breadcrumb_item_list' meta tag.
 *
 * @MetatagTag(
 *   id = "schema_breadcrumb_item_list",
 *   label = @Translation("itemListElement"),
 *   description = @Translation("Add the breadcrumb for current web page to Schema.org structured data?"),
 *   name = "itemListElement",
 *   group = "schema_breadcrumb_list",
 *   weight = 1,
 *   type = "string",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaBreadcrumbItemList extends SchemaNameBase {

  /**
   * Generate a form element for this meta tag.
   */
  /**
   * Generate a form element for this meta tag.
   */
  public function form(array $element = []) {
    $form = [
      '#type' => 'select',
      '#title' => $this->label(),
      '#default_value' => $this->value(),
      '#empty_option' => t('No'),
      '#empty_value' => '',
      '#options' => [
        'Yes' => $this->t('Yes'),
      ],
      '#description' => $this->description(),
      '#element_validate' => [[get_class($this), 'validateTag']],
    ];
    return $form;
  }

  public function output() {
    $element = parent::output();
    if (!empty($element)) {
      $entity_route = \Drupal::service('current_route_match')->getCurrentRouteMatch();
      $breadcrumbs = \Drupal::service('breadcrumb')->build($entity_route)->getLinks();

      $key = 1;
      $element['#attributes']['content'] = [];
      foreach ($breadcrumbs as $item) {
       $element['#attributes']['content'][] = [
          '@type' => 'ListItem',
          'position' => $key,
          'item' => [
            '@id' => $item->getUrl()->setAbsolute()->toString(),
            'name' => $item->getText()->render(),
          ],
        ];
        $key++;
      }
    }
    return $element;
  }
}
