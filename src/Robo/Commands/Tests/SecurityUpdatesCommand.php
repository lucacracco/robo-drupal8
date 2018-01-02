<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Tests;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "tests" namespace.
 */
class SecurityUpdatesCommand extends RoboDrupal8Tasks {

  /**
   * Check local Drupal installation for security updates.
   *
   * @command tests:security-updates
   *
   * @description Check local Drupal installation for security updates.
   */
  public function testsSecurityUpdates() {
    $result = $this->taskDrush()
      ->drush("pm:security")
      ->run();

    if ($result->getExitCode()) {
      $this->logger->notice('To disable security checks, set disable-targets.tests.security-updates to false in project.yml.');
      return 1;
    }
    else {
      $this->writeln("<info>There are no outstanding security updates for Drupal projects.</info>");
      return 0;
    }
  }

}
