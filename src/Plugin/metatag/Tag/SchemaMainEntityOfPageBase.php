<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

/**
 * Schema.org MainEntityOfPage items should extend this class.
 */
abstract class SchemaMainEntityOfPageBase extends SchemaNameBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function form(array $element = []) {
    $form = parent::form($element);
    $form['#attributes']['placeholder'] = '[current-page:url]';
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function output() {
    $element = parent::output();
    if (!empty($element)) {
      $element['#attributes']['group'] = $this->group;
      $element['#attributes']['schema_metatag'] = $this->schemaMetatag();
      $element['#attributes']['content'] = [
        '@type' => 'WebPage',
        '@id' => $this->value(),
      ];
    }
    return $element;
  }

}
