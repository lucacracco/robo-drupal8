<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "drupal:core-cron" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Drupal
 */
class CoreCronCommand extends RoboDrupal8Tasks {

  /**
   * Launch drupal core cron.
   *
   * @command drupal:core-cron
   *
   * @validateDrupalIsInstalled
   */
  public function coreCron() {
    $this->taskDrush()
      ->drush('core-cron')
      ->printOutput(TRUE)
      ->run();
  }

}
