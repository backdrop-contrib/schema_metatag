<?php

/**
 * Provides a plugin for the 'trueFalseBase' meta tag.
 */
class SchemaTrueFalseBase extends SchemaNameBase {

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = []) {
    $form = parent::getForm($options);
    $form['value']['#type'] = 'select';
    $form['value']['#empty_option'] = t('- None -');
    $form['value']['#empty_value'] = '';
    $form['value']['#options'] = ['False' => 'False', 'True' => 'True'];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return 'True';
  }

}
