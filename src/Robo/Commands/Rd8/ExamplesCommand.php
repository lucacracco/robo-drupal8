<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Rd8;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;

/**
 * Defines commands in the "examples:*" namespace.
 */
class ExamplesCommand extends RoboDrupal8Tasks {

  /**
   * Generate example files for writing custom commands and hooks.
   *
   * @todo: add example command with robo.yml, see https://github.com/ec-europa/oe-task-runner.
   *
   * @command examples:init
   */
  public function init() {
    $result = $this->taskFilesystemStack()
      ->copy(
        $this->getConfigValue('rd8.root') . '/scripts/robo-drupal8/examples/Commands/ExampleCommand.php',
        $this->getConfigValue('project.root') . '/robo-drupal8/src/Commands/ExampleCommand.php', FALSE)
      ->copy(
        $this->getConfigValue('rd8.root') . '/scripts/robo-drupal8/examples/Hooks/ExampleHook.php',
        $this->getConfigValue('project.root') . '/robo-drupal8/src/Hooks/ExampleHook.php', FALSE)
      ->stopOnFail()
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
      ->run();

    if (!$result->wasSuccessful()) {
      throw new \Exception("Could not copy example files into the repository root.");
    }

    $this->say("<info>Example commands and hooks were copied to your repository root.</info>");
  }

}
