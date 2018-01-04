<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Validate;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "validate:all*" namespace.
 */
class ValidateCommand extends RoboDrupal8Tasks {

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
      'validate:phpcs',
    ]);

    return $status_code;
  }

  /**
   * Validates root composer.json and composer.lock files.
   *
   * @command validate:composer
   */
  public function validateComposer() {
    $this->invokeCommands([
      'composer:validate',
    ]);
  }

}
