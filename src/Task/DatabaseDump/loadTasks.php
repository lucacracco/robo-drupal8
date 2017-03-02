<?php

namespace Lucacracco\Drupal8\Robo\Task\DatabaseDump;

/**
 * Class loadTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task\DatabaseDump
 */
trait loadTasks {

  /**
   * Export project database dump.
   *
   * @param string $file_path
   *   The file path of the database dump.
   *
   * @return Dump
   */
  protected function taskDatabaseDumpExport($file_path) {
    return $this->task(Dump::class, $file_path)->export();
  }

  /**
   * Import project database dump.
   *
   * @param string $file_path
   *   The file path of the database dump.
   *
   * @return Dump
   */
  protected function taskDatabaseDumpImport($file_path) {
    return $this->task(Dump::class, $file_path)->import();
  }

}
