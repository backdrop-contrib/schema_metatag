<?php

/**
 * Provides a plugin for the 'schema_date_base' meta tag.
 */
class SchemaDateBase extends SchemaNameBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function getForm(array $options = []) {
    $form = parent::getForm($options);
    $form['value']['#description'] .= ' ' . $this->t('To format the date properly, use a token like [node:created:custom:Y-m-d\TH:i:sO].');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return parent::testDefaultValue(1, '');
  }

}
