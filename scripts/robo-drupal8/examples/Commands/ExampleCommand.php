<?php

namespace Lucacracco\RoboDrupal8\Custom\Commands;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "custom" namespace.
 */
class ExampleCommand extends RoboDrupal8Tasks {

  /**
   * Print "Hello world!" to the console.
   *
   * @command custom:hello
   *
   * @description This is an example command.
   */
  public function hello() {
    $this->say("Hello world!");
  }

}
