<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Sync;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Class ImportCommand.
 *
 * Defines commands in the "setup:import" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Sync
 */
class ImportCommand extends RoboDrupal8Tasks {

  /**
   * Imports a .sql file into the Drupal database.
   *
   * @command setup:import
   *
   * @validateDrushConfig
   */
  public function import() {
    $task = $this->taskDrush()
      ->drush('sql-drop')
      ->drush('sql-cli < ' . $this->getConfigValue('setup.dump-file'));
    $result = $task->run();
    $exit_code = $result->getExitCode();

    if ($exit_code) {
      throw new \Exception("Unable to import setup.dump-file.");
    }
  }

}
