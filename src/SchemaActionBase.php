<?php

/**
 * Schema.org Action items should extend this class.
 */
class SchemaActionBase extends SchemaNameBase {

  use SchemaActionTrait;

  /**
   * Allowed actions.
   *
   * @var array
   */
  protected $actions;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $info, array $data = NULL) {
    parent::__construct($info, $data);
    $this->actions = [];
  }

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = []) {

    $value = $this->schemaMetatagManager()->unserialize($this->value());

    $input_values = [
      'title' => $this->label(),
      'description' => $this->description(),
      'value' => $value,
      '#required' => isset($options['#required']) ? $options['#required'] : FALSE,
      'visibility_selector' => $this->visibilitySelector(),
      'actions' => $this->actions,
    ];

    $form['value'] = $this->actionForm($input_values);

    if (empty($this->multiple())) {
      unset($form['value']['pivot']);
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
    $keys = [
      '@type',
      'target',
    ];
    foreach ($keys as $key) {
      switch ($key) {

        case '@type':
          $items[$key] = 'Action';
          break;

        case 'target':
          $items[$key] = SchemaEntryPointBase::testValue();
          break;

        default:
          $items[$key] = parent::testDefaultValue(1, '');
          break;

      }
    }
    return $items;

  }

  /**
   * {@inheritdoc}
   */
  public static function processedTestValue($items) {
    foreach ($items as $key => $value) {
      switch ($key) {
        case 'target':
          $items[$key] = SchemaEntryPointBase::processedTestValue($items[$key]);
          break;

      }
    }
    return $items;

  }

}
