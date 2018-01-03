<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "setup:import" namespace.
 */
class ImportCommand extends RoboDrupal8Tasks {

  /**
   * Imports a .sql file into the Drupal database.
   *
   * @command setup:importreports.localDir
   *
   * @validateDrushConfig
   */
  public function import($dump_file) {
    if (file_exists($dump_file)) {
      throw new \InvalidArgumentException("Dump file $dump_file not valid.");
    }

    $task = $this->taskDrush()
      ->drush('sql-drop')
      ->drush('sql-cli < ' . $dump_file);
    $result = $task->run();
    $exit_code = $result->getExitCode();

    if ($exit_code) {
      throw new \Exception("Unable to import setup.dump-file.");
    }
  }

}
