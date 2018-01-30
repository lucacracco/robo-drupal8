<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "drupal:locale:*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Drupal
 */
class LocaleCommand extends RoboDrupal8Tasks {

  /**
   * Imports the available translation updates.
   *
   * @command drupal:locale:update
   *
   * @validateDrupalIsInstalled
   */
  public function update() {
    $this->taskDrush()
      ->drush("locale-update")
      ->printOutput(TRUE)
      ->run();
  }

  /**
   * Checks for available translation updates.
   *
   * @command drupal:locale:check
   *
   * @validateDrupalIsInstalled
   */
  public function check() {
    $this->taskDrush()
      ->drush("locale-check")
      ->printOutput(TRUE)
      ->run();
  }

}
