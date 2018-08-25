<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "drupal:database:*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Drupal
 */
class DatabaseCommand extends RoboDrupal8Tasks {

  /**
   * Drop tables.
   *
   * @command drupal:database:drop
   *
   * @interactConfirmCommand
   */
  public function drop() {
    $this->taskDrush()
      ->drush('sql-drop')
      ->printOutput(TRUE)
      ->run();
  }

  /**
   * Import database.
   *
   * @param string $dump_file Path of dump file to import.
   *
   * @throws \Exception
   * @throws \Psr\Container\ContainerExceptionInterface
   * @throws \Psr\Container\NotFoundExceptionInterface
   *
   * @command drupal:database:import
   *
   * @validateMySqlAvailable
   */
  public function import($dump_file) {
    $this->invokeCommand("drupal:database:drop");
    $this->taskDrush()
      ->drush('sql-cli < ')
      ->arg($dump_file)
      ->printOutput(TRUE)
      ->run();
  }

  /**
   * Export database.
   *
   * TODO: add gzip dump.
   *
   * @option directory Where to save the dump file.
   *
   * @command drupal:database:export
   *
   * @validateDatabaseExportDir
   * @validateDrupalIsInstalled
   */
  public function export($opts = ['directory' => NULL]) {
    $path = !empty($opts['directory']) ? $opts['directory'] : $this->getConfigValue("drupal.database.dir_export");

    if (empty($path) || !file_exists($path)) {
      throw new \InvalidArgumentException("Path \"$path\" where to save the dump is not found.");
    }

    $path = $path . DIRECTORY_SEPARATOR . $this->getConfigValue("site") . "_" . date('Ymd_Hm') . ".sql";

    $this->invokeCommand('drupal:cache:rebuild');

    $this->taskDrush()
      ->drush("sql-dump")
      ->option('result-file', $path)
      ->printOutput(TRUE)
      ->run();
  }

}
