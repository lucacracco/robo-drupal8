<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Tests;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "tests" namespace.
 */
class AllCommand extends RoboDrupal8Tasks {

  /**
   * Runs all tests, including PHPUnit, and security updates check.
   *
   * @command tests
   *
   * @aliases tests:all
   * @executeInDrupalVm
   */
  public function tests() {
    $this->invokeCommands([
      'tests:phpunit',
      'tests:security-updates',
      'frontend:test',
    ]);
  }

}
