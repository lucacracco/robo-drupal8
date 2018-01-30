<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "drupal:extension:*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Drupal
 */
class ExtensionCommand extends RoboDrupal8Tasks {

  /**
   * Enable module.
   *
   * @param $module
   *
   * @command drupal:extension:enable
   *
   * @validateDrupalIsInstalled
   */
  public function enable($module) {
    $this->taskDrush()
      ->drush('pm-enable')
      ->arg($module)
      ->printOutput(TRUE)
      ->run();
  }

  /**
   * Uninstall module.
   *
   * @param $module
   *
   * @command drupal:extension:uninstall
   *
   * @validateDrupalIsInstalled
   */
  public function uninstall($module) {
    $this->taskDrush()
      ->drush('pm-uninstall')
      ->arg($module)
      ->printOutput(TRUE)
      ->run();
  }

}
