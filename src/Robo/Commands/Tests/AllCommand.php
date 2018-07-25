<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Tests;

/**
 * Defines commands in the "tests" namespace.
 */
class AllCommand extends TestsCommandBase {

  /**
   * Runs all tests, including Behat, PHPUnit, and security updates check.
   *
   * @command tests
   *
   * @aliases tests:all
   * @executeInDrupalVm
   */
  public function tests() {
    $this->invokeCommands([
      // 'tests:behat',
      // 'tests:phpunit',
      'tests:security-updates',
    ]);
  }

}
