<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "setup:config*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Setup
 */
class ConfigCommand extends RoboDrupal8Tasks {

  /**
   * Update current database to reflect the state of the Drupal file system.
   *
   * @command setup:update
   * @aliases su
   */
  public function update() {
    $this->invokeCommands(['setup:config-import']);
  }



}