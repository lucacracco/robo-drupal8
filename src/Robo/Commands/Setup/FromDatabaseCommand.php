<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "setup:from-database:*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Setup
 */
class FromDatabaseCommand extends RoboDrupal8Tasks {

  /**
   * Setup project and install Drupal from database.
   *
   * @command setup:from-database
   *
   * @param $database_dump
   *
   * @throws \Exception
   * @throws \Psr\Container\ContainerExceptionInterface
   * @throws \Psr\Container\NotFoundExceptionInterface
   */
  public function fromDatabase($database_dump, $local = FALSE) {
    $this->invokeCommands([
      'install-alias',
      'composer:install',
      'drupal:filesystem:clear',
      'drupal:install-scratch',
    ]);
    $this->invokeCommand('drupal:database:import', [$database_dump]);
    $this->invokeCommands([
      'drupal:settings',
      'drupal:update',
      'drupal:filesystem:protect-site',
      'drupal:core-cron',
    ]);
  }

}
