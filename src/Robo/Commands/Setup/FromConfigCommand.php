<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "setup:from-config:*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Setup
 */
class FromConfigCommand extends RoboDrupal8Tasks {

  /**
   * Setup project and install Drupal from configuration directory.
   *
   * @command setup:from-config
   *
   * @throws \Exception
   * @throws \Psr\Container\ContainerExceptionInterface
   * @throws \Psr\Container\NotFoundExceptionInterface
   */
  public function fromConfig() {
    $this->invokeCommands([
      'composer:install',
      'drupal:filesystem:clear',
      'drupal:install-with-config-installer',
      'drupal:update',
      'drupal:filesystem:protect-site',
      'drupal:core-cron',
    ]);
  }

}
