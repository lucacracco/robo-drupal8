<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Robo task: Apply entity schema updates.
 */
class ApplyEntitySchemaUpdates extends DrushTask {

  /**
   * {@inheritdoc}
   */
  public function run() {
    $this->collection->add(
      $this->drushStack()
        ->drush('entity-updates')
    );
    return parent::run();
  }

}
