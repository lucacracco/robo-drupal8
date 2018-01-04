<?php

namespace Lucacracco\RoboDrupal8\Custom\Hooks;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Symfony\Component\Console\Event\ConsoleCommandEvent;

/**
 * This class defines example hooks.
 */
class ExampleHook extends RoboDrupal8Tasks {

  /**
   * This will be called before the `custom:hello` command is executed.
   *
   * @hook command-event custom:hello
   */
  public function preExampleHello(ConsoleCommandEvent $event) {
    $command = $event->getCommand();
    $this->say("preCommandMessage hook: The {$command->getName()} command is about to run!");
  }

}
