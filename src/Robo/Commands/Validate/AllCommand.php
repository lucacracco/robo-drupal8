<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Validate;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "validate:all*" namespace.
 */
class AllCommand extends RoboDrupal8Tasks {

  /**
   * Runs all code validation commands.
   *
   * @command validate
   *
   * @aliases validate:all
   */
  public function all() {
    $status_code = $this->invokeCommands([
      'validate:composer',
      // TODO: add phpcs, phpunit.
    ]);

    return $status_code;
  }

}
