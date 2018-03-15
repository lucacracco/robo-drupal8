<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines command in the "setup:deploy:*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Setup
 */
class DeployCommand extends RoboDrupal8Tasks {

  /**
   * Setup project and deploy the drupal site exist.
   *
   * @command setup:deploy
   *
   * @throws \Exception
   * @throws \Psr\Container\ContainerExceptionInterface
   * @throws \Psr\Container\NotFoundExceptionInterface
   */
  public function deploy() {
    $this->invokeCommands([
      'composer:install',
      'drupal:update',
      'drupal:configuration:import',
      'drupal:filesystem:protect-site',
      'drupal:core-cron',
    ]);
  }

}
