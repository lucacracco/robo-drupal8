<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "drupal:configuration:*" namespaces.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Drupal
 */
class ConfigurationCommand extends RoboDrupal8Tasks {

  /**
   * Import configuration of drupal.
   *
   * @command drupal:configuration:import
   * @aliases dci
   *
   * @option report Print output command
   *
   * @validateDrupalIsInstalled
   * @validateDrupalConfigurationDirectorySync
   */
  public function import($opts = ['report' => FALSE]) {
    $this->invokeCommand('drupal:cache:rebuild');
    $this->taskDrush()
      ->drush('config-import')
      ->printOutput((boolean) $opts['report'])
      ->run();
    $this->invokeCommand('drupal:cache:rebuild');
  }

  /**
   * Export configuration of drupal.
   *
   * @command drupal:configuration:export
   * @aliases dce
   *
   * @arg config_export Destination directory_sync to save the configurations.
   * @option report Print output command
   *
   * @validateDrupalIsInstalled
   * @validateDrupalConfigurationDirectorySync
   */
  public function export($config_export = 'sync', $opts = ['report' => FALSE]) {
    $this->invokeCommand('drupal:cache:rebuild');
    $this->taskDrush()
      ->drush('config-export')
      ->arg($config_export)
      ->printOutput((boolean) $opts['report'])
      ->run();
  }

}
