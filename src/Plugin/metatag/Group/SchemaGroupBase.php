<?php

namespace Drupal\schema_metatag\Plugin\metatag\Group;

use \Drupal\metatag\Plugin\metatag\Group\GroupBase;

/**
 * Schema.org groups should extend this class.
 */
abstract class SchemaGroupBase extends GroupBase {

  /**
   * Whether this is structured data.
   *
   * @var boolean
   */
  protected $schema_metatag;

  public function __construct(array $configuration, $plugin_id, array $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->schema_metatag = $plugin_definition['schema_metatag'];
  }

  public function schema_metatag() {
    return $this->schema_metatag;
  }
}
