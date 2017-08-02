<?php

/**
 * All Schema.org tags should extend this class.
 */
class SchemaNameBase extends DrupalTextMetaTag {

  /**
   * Wrappers to create D7 methods that match D8 format.
   * To make it possible to re-use some D8 code.
   */
  public function t($str) {
    return t($str);
  }
  public function getPluginId() {
    return $this->info['name'];
  }
  public function label() {
    return $this->info['label'];
  }
  public function description() {
    return $this->info['description'];
  }
  public function value() {
    return !empty($this->data['value']) ? $this->data['value'] : '';
  }

  /**
   * The #states visibility selector for this element.
   */
  protected function visibilitySelector() {
    return 'metatags[und][' . $this->info['name'] . '][value]';
  }

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = array()) {
    $form = parent::getForm($options);

    // Add a validation callback to serialize nested arrays.
    $form['value']['#element_validate'][] = 'schema_metatag_element_validate';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getElement(array $options = array()) {

    $this->options = $options;

    $value = SchemaMetatagManager::unserialize($this->value());

    if (empty($value)) {
      return '';
    }
    // If this is a complex array of values, process the array.
    elseif (is_array($value)) {

      // Clean out empty values.
      $value = array_filter($value);

      // If the item is an array of values,
      // walk the array and process the values.
      array_walk_recursive($value, 'self::process_item');

      // See if any nested items need to be pivoted.
      // If pivot is set to 0, it would have been removed as an empty value.
      if (array_key_exists('pivot', $value)) {
        unset($value['pivot']);
        $value = SchemaMetatagManager::pivot($value);
      }

    }
    // Process a simple string.
    else {
      $this->process_item($value);
    }
    $parts = explode('.', $this->info['name']);
    $id = 'schema_metatag_' . $this->info['name'];
    $element = [
      '#type' => 'html_tag',
      '#tag' => 'meta',
      '#attributes' => [
        'schema_metatag' => TRUE,
        'group' => $parts[0],
        'name' => $parts[1],
        'content' => $value,
      ]
    ];
    return array(
      '#attached' => array('drupal_add_html_head' => array(array($element, $id))),
    );
  }

  /**
   * Process an individual item.
   *
   * This is a copy of the original processing done by Metatag module,
   * but applied to every item on the array of values.
   */
  protected function process_item(&$value, $key = 0) {

    // $this->getValue() processes whatever is in $this->data['value'],
    // so swap in the individual value being processed, do the processing,
    // then return to the original value.
    $backup_value = $this->data['value'];
    $this->data['value'] = $value;
    $value = $this->getValue($this->options);
    $this->data['value'] = $backup_value;

    if (!empty($this->info['multiple'])) {
      $value = SchemaMetatagManager::explode($value);
    }

  }

}
