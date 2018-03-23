<?php

/**
 * Provides a plugin for the 'employmentType' meta tag.
 */
class SchemaJobPostingEmploymentType extends SchemaNameBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function getForm(array $options = []) {
    $form['value'] = [
      '#type' => 'select',
      '#title' => $this->label(),
      '#description' => $this->description(),
      '#empty_option' => t('- None -'),
      '#empty_value' => '',
      '#options' => $this->types(),
      '#default_value' => $this->value(),
    ];
    return $form;
  }

  /**
   * Return a list of employment types.
   */
  private function types() {
    $types = [
      'FULL-TIME',
      'PART-TIME',
      'CONTRACT',
      'TEMPORARY',
      'SEASONAL',
      'INTERNSHIP',
    ];
    return array_combine($types, $types);
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return 'FULL-TIME';
  }

}
