<?php

/**
 * Provides a plugin for the 'schema_organization_potential_action' meta tag.
 */
class SchemaOrganizationPotentialAction extends SchemaActionBase {

  /**
   * Generate a form element for this meta tag.
   */
  public function getForm(array $options = []) {

    $this->actions = ['Action', 'TradeAction', 'OrganizeAction', 'OrderAction', 'ReserveAction'];

    $form = parent::getForm($options);
    return $form;
  }

}
