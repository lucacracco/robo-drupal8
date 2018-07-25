<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "setup:scratch:*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Setup
 */
class ScratchCommand extends RoboDrupal8Tasks {

  /**
   * Setup project and install drupal scratch from RD8 configuration.
   *
   * @command setup:scratch
   *
   * @throws \Exception
   * @throws \Psr\Container\ContainerExceptionInterface
   * @throws \Psr\Container\NotFoundExceptionInterface
   */
  public function scratch() {
    $this->invokeCommands([
      'composer:install',
      'drupal:filesystem:clear',
      'drupal:install-scratch',
      'drupal:settings',
      'drupal:update',
      'drupal:filesystem:protect-site',
      'drupal:core-cron',
    ]);
  }

}
