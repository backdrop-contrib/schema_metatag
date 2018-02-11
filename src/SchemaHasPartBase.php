<?php

/**
 * Provides a plugin for the 'hasPart' meta tag.
 *
 * Currently applies only to isAccessibleForFree.
 *
 * @see https://developers.google.com/search/docs/data-types/paywalled-content
 */
class SchemaHasPartBase extends SchemaNameBase {

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = []) {
    $form = parent::getForm($options);
    $form['value']['#description'] = $this->t('Comma-separated list of class names of the parts of the web page that are not free. Do NOT surround class names with quotation marks! Also fill out "isAccessibleForFree".');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return parent::testDefaultValue(3, ',');
  }

  /**
   * {@inheritdoc}
   */
  public static function outputValue($input_value) {
    if (is_string($input_value)) {
      $input_value = SchemaMetatagManager::explode($input_value);
    }
    foreach ((array) $input_value as $class_name) {
      $items[] = [
        '@type' => 'WebPageElement',
        'isAccessibleForFree' => 'False',
        'cssSelector' => '.' . $class_name,
      ];
    }
    return !empty($items) ? $items : '';
  }

}
