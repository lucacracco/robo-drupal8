<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Tests;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;

/**
 * Defines commands in the "tests" namespace.
 */
class TestsCommandBase extends RoboDrupal8Tasks {

  /**
   * Creates the reports directory, if it does not exist.
   */
  protected function createReportsDir() {
    // Create reports dir.
    $logs_dir = $this->getConfigValue('repo.root') . "/reports";
    $this->taskFilesystemStack()
      ->mkdir($logs_dir)
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
      ->run();
  }

}
