<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Robo task: Apply database updates.
 */
class ApplyDatabaseUpdates extends DrushTask {

  /**
   * {@inheritdoc}
   */
  public function run() {
    $this->collection->add(
      $this->drushStack()
      ->optionForNextCommand('entity-updates')
      ->drush('updatedb')
    );
    return parent::run();
  }

}
