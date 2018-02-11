<?php

/**
 * Provides a plugin for the 'isAccessibleForFree' meta tag.
 */
abstract class SchemaIsAccessibleForFreeBase extends SchemaNameBase {

  /**
   * {@inheritdoc}
   */
  public function form(array $element = []) {
    $form = parent::form($element);
    $form['value']['#type'] = 'select';
    $form['value']['#empty_option'] = t('True');
    $form['value']['#empty_value'] = '';
    $form['value']['#options'] = ['False' => 'False'];
    $form['value']['#description'] = $this->t('Whether this object is accessible for free. If used on a CreativeWork, like a WebPage or Article, be sure to fill out "hasPart" as well.');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return 'False';
  }

}
