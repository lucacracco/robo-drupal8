<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Tests;

/**
 * Defines commands in the "tests" namespace.
 */
class SecurityUpdatesCommand extends TestsCommandBase {

  /**
   * Check local Drupal installation for security updates.
   *
   * @command tests:security-updates
   *
   * @description Check local Drupal installation for security updates.
   *
   */
  public function testsSecurityUpdates() {
    $result = $this->taskDrush()
      ->drush("pm:security")
      ->run();

    if ($result->getExitCode()) {
      $this->writeln("<info>There are security updates for Drupal projects.</info>");
      return 1;
    }
    else {
      $this->writeln("<info>There are no outstanding security updates for Drupal projects.</info>");
      return 0;
    }
  }

}
