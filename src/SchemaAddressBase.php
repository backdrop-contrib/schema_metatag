<?php

/**
 * Schema.org PostalAddress items should extend this class.
 */
class SchemaAddressBase extends SchemaNameBase {

  use SchemaAddressTrait;
  use SchemaPivotTrait;

  /**
   * The top level keys on this form.
   */
  public static function formKeys() {
    return ['pivot'] + self::postalAddressFormKeys();
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

    $form = parent::getForm($options);
    $form['value'] = $this->postalAddressForm($input_values);

    if (!empty($this->info['multiple'])) {
      $form['value']['pivot'] = $this->pivotForm($value);
      $selector = ':input[name="' . $input_values['visibility_selector'] . '"]';
      $form['value']['pivot']['#states'] = ['invisible' => [$selector => ['value' => '']]];
    }

    // Validation from parent::getForm() got wiped out, so add callback.
    $form['value']['#element_validate'][] = 'schema_metatag_element_validate';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    $items = [];
    $keys = self::postalAddressFormKeys();
    foreach ($keys as $key) {
      switch ($key) {
        case '@type':
          $items[$key] = 'PostalAddress';
          break;

        default:
          $items[$key] = parent::testDefaultValue(2, ' ');
          break;

      }
    }
    return $items;
  }

}
