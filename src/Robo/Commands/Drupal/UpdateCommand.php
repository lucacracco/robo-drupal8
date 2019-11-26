<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "drupal:update" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Drupal
 */
class UpdateCommand extends RoboDrupal8Tasks {

  /**
   * Update drupal core and entities.
   *
   * @command drupal:update
   *
   * @validateDrupalIsInstalled
   */
  public function update() {
    $this->invokeCommands(['drupal:update:database', 'drupal:update:entities']);
  }

  /**
   * Drupal update database command.
   *
   * @command drupal:update:database
   *
   * @option entity-updates Run automatic entity schema updates at the end of
   *   any update hooks.
   *
   * @validateDrupalIsInstalled
   */
  public function updateDatabase($opts = ['entity-updates' => FALSE]) {
    $task = $this->taskDrush()
      ->drush('updatedb');
    $task
      ->printOutput(TRUE)
      ->run();
  }

  /**
   * Drupal update entities command.
   *
   * TODO: only if drupal version < 8.7.
   *
   * @command drupal:update:entities
   *
   * @validateDrupalIsInstalled
   */
  public function entityUpdate() {
    //$this->taskDrush()
    //  ->drush('entity-updates')
    //  ->printOutput(TRUE)
    //  ->run();
  }

}
