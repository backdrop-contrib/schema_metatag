<?php

/**
 * All Schema.org views itemListElement tags should extend this class.
 */
class SchemaItemListElementViewsBase extends SchemaItemListElementBase {

  /**
   * {@inheritdoc}
   */
  public function getForm(array $options = []) {
    $form = parent::getForm($options);
    $form['value']['#attributes']['placeholder'] = 'view_name:display_id';
    $form['value']['#description'] = $this->t('To display a Views list in Schema.org structured data, provide the machine name of the view, and the machine name of the display, separated by a colon.');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return 'frontpage:page_1';
  }

  /**
   * {@inheritdoc}
   */
  public static function getItems($input_value) {
    $values = [];
    $ids = explode(':', $input_value);
    if (count($ids) == 2) {
      $view_id = $ids[0];
      $display_id = $ids[1];
      // Get the view results.
      $view = $this->options['token data']['view'];
      $id = $view->base_field;
      $entity_type = $view->base_table;
      $key = 1;
      $value = [];
      foreach ($view->result as $key => $item) {
        // If this is a display that does not provide an entity in the result,
        // there is really nothing more to do.
        if (!empty($item->$id)) {
          // Get the absolute path to this entity.
          $entity = entity_load($entity_type, [$item->$id]);
          $entity = array_shift($entity);
          $uri = entity_uri($entity_type, $entity);
          $url = drupal_get_path_alias($uri['path']);
          $absolute = url($url, array('absolute' => TRUE));
          $value[$key] = [
            '@id' => $url,
            'name' => $entity->title,
          ];
        }
      }
    }
    return !empty($values) ? $values : '';
  }

}
