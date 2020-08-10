<?php

/**
 * Provides a plugin for the 'schema_web_site_potential_action' meta tag.
 */
class SchemaWebSitePotentialAction extends SchemaActionBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function getForm(array $options = []) {

    $this->actions = ['Action', 'SearchAction'];

    $form = parent::getForm($options);
    return $form;
  }

}
