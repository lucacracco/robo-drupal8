<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Frontend;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "frontend:*" namespace.
 */
class FrontendCommand extends RoboDrupal8Tasks {

  /**
   * Runs all frontend targets.
   *
   * @command frontend
   */
  public function frontend() {
    $this->invokeCommands([
      'frontend:setup',
      'frontend:build',
    ]);
  }

  /**
   * Executes frontend-build target hook.
   *
   * @command frontend:build
   */
  public function build() {

  }

  /**
   * Executes frontend-setup target hook.
   *
   * @command frontend:setup
   */
  public function setup() {

  }

  /**
   * Executes frontend-test target hook.
   *
   * @command frontend:test
   */
  public function test() {

  }

}
