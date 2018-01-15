<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "setup:all" namespace.
 */
class AllCommand extends RoboDrupal8Tasks {

  /**
   * Install dependencies, builds docroot, installs Drupal.
   *
   * @command setup
   *
   * @aliases setup:all
   */
  public function setup() {
    $this->say("Setting up local environment for site <comment>{$this->getConfigValue('site')}</comment>.");
    if ($this->getConfigValue('drush.alias')) {
      $this->say("Using drush alias <comment>@{$this->getConfigValue('drush.alias')}</comment>");
    }

    $commands = [
      'setup:build',
      'setup:hash-salt',
    ];
    $commands[] = 'setup:drupal:install';
    $commands[] = 'setup:import';
    $commands[] = 'setup:update';
    $commands[] = 'install-alias';
    $this->invokeCommands($commands);
  }

}