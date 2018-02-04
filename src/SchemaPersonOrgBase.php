<?php

/**
 * Schema.org Person/Org items should extend this class.
 */
class SchemaPersonOrgBase extends SchemaNameBase {

  /**
   * Traits provide re-usable form elements.
   */
  use SchemaPersonOrgTrait;
  use SchemaPivotTrait;

  /**
   * The top level keys on this form.
   */
  public function formKeys() {
    return ['pivot'] + self::personOrgFormKeys();
  }

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = []) {

    $value = SchemaMetatagManager::unserialize($this->value());

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => $value,
      '#required' => isset($element['#required']) ? $element['#required'] : FALSE,
      'visibility_selector' => $this->visibilitySelector() . '[@type]',
    ];

    $form['value'] = $this->personOrgForm($input_values);

    // Validation from parent::getForm() got wiped out, so add callback.
    $form['value']['#element_validate'][] = 'schema_metatag_element_validate';

    if (!empty($this->info['multiple'])) {
      $form['value']['pivot'] = $this->pivotForm($value);
      $form['value']['pivot'] = $this->pivotForm($value);
      $selector = ':input[name="' . $input_values['visibility_selector'] . '"]';
      $form['value']['pivot']['#states'] = ['invisible' => [$selector => ['value' => '']]];
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    $items = [];
    $keys = self::personOrgFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case 'pivot':
          break;

        case 'logo':
          $items[$key] = SchemaImageBase::testValue();
          break;

        case '@type':
          $items[$key] = 'Organization';
          break;

        default:
          $items[$key] = parent::testDefaultValue(2, ' ');
          break;

      }
    }
    return $items;
  }

}
