<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Robo task: Drop all database tables.
 */
class SqlDrop extends DrushTask {

  /**
   * {@inheritdoc}
   */
  public function run() {
    return $this->drushStack()
      ->drush('sql-drop')
      ->run();
  }

}
