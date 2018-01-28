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
   * @validateDrupalIsInstalled
   * @validateDrupalConfigurationDirectorySync
   */
  public function import() {
    $this->invokeCommand('drupal:cache:rebuild');

  }

  /**
   * Export configuration of drupal.
   *
   * @command drupal:configuration:export
   * @aliases dce
   *
   * @interactGenerateConfigurationDirectorySync
   *
   * @validateDrupalIsInstalled
   * @validateDrupalConfigurationDirectorySync
   */
  public function export() {
    $this->invokeCommand('drupal:cache:rebuild');

  }

}
