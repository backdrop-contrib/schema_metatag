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
    $form['value']['#description'] = $this->t("Provide the machine name of the view, and the machine name of the display, separated by a colon, i.e. 'view_name:display_id'. This will create a <a href=':url'>Summary View</a> list, which assumes each list item contains the url to a view page for the entity. The view rows should contain content (like teaser views) rather than fields for this to work correctly.", [':url' => 'https://developers.google.com/search/docs/guides/mark-up-listings']);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function testValue() {
    return 'frontpage:page';
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
      $view = views_get_view($view_id);
      $view->set_display($display_id);
      $view->pre_execute();
      $view->execute();

      $id = $view->base_field;
      $entity_type = $view->base_table;
      $values = [];
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
          $values[$key + 1] = [
            '@id' => $url,
            'name' => $entity->title,
            'url' => $absolute,
          ];
        }
      }
    }
    return !empty($values) ? $values : '';
  }

}
