<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Fix;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "fix:phpcbf*" namespace.
 */
class PhpCbfCommand extends RoboDrupal8Tasks {

  /**
   * Fixes and beautifies custom code according to Drupal Coding standards.
   *
   * @command fix:phpcbf
   */
  public function phpcbfFileSet($directory = '') {
    $this->say('Fixing and beautifying code...');

    $bin = $this->getConfigValue('composer.bin');
    $dir = empty($directory) ? $this->getConfigValue('project.docroot') : $directory;
    $result = $this->taskExec("$bin/phpcbf")
      ->dir($dir)
      ->run();

    $exit_code = $result->getExitCode();
    // - 0 indicates that no fixable errors were found.
    // - 1 indicates that all fixable errors were fixed correctly.
    // - 2 indicates that PHPCBF failed to fix some of the fixable errors.
    // - 3 is used for general script execution errors.
    switch ($exit_code) {
      case 0:
        $this->say('<info>No fixable errors were found, and so nothing was fixed.</info>');
        return 0;

      case 1:
        $this->say('<comment>Please note that exit code 1 does not indicate an error for PHPCBF.</comment>');
        $this->say('<info>All fixable errors were fixed correctly. There may still be errors that could not be fixed automatically.</info>');
        return 0;

      case 2:
        $this->logger->warning('PHPCBF failed to fix some of the fixable errors it found.');
        return $exit_code;

      default:
        throw new \Exception("PHPCBF failed.");
    }
  }

}
