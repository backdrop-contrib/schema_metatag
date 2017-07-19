<?php

namespace Drupal\schema_metatag\Plugin\metatag\Tag;

/**
 * Schema.org Person/Org items should extend this class.
 */
abstract class SchemaPersonOrgBase extends SchemaNameBase {

  /**
   * Traits provide re-usable form elements, like postal_address.
   */
  use SchemaPersonOrgTrait;

  /**
   * The top level keys on this form.
   */
  function form_keys() {
    return $this->person_org_form_keys();
  }

  /**
   * Generate a form element for this meta tag.
   *
   * We need multiple values, so create a tree of values and
   * stored the serialized value as a string.
   */
  public function form(array $element = []) {

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => $this->unserialize($this->value()),
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->getPluginId() . '[@type]',
    ];

    // Totally hide the logo unless this is an organization.
    $form = $this->person_org_form($input_values);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function output() {
    $element = parent::output();

    if (!empty($element)) {
      $content = $this->unserialize($this->value());

      // If there is no value, don't create a tag.
      $keys = $this->form_keys();
      $empty = TRUE;
      foreach ($keys as $key) {
        if (!empty($content[$key])) {
          $empty = FALSE;
          break;
        }
      }
      if ($empty) {
        return '';
      }
      $element['#attributes']['group'] = $this->group;
      $element['#attributes']['schema_metatag'] = $this->schemaMetatag();
      $element['#attributes']['content'] = [];
      foreach ($keys as $key) {
        $value = !empty($content[$key]) ? $content[$key] : '';
        if (!empty($value)) {
          $element['#attributes']['content'][$key] = $value;
        }
      }
    }
    return $element;
  }


}
