<?php

namespace Lucacracco\RoboDrupal8\Robo;

use League\Container\ContainerAwareInterface;
use League\Container\ContainerAwareTrait;
use Lucacracco\RoboDrupal8\Robo\Common\ArrayManipulator;
use Lucacracco\RoboDrupal8\Robo\Config\ConfigAwareTrait;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Robo\Common\IO;
use Robo\Contract\BuilderAwareInterface;
use Robo\Contract\ConfigAwareInterface;
use Robo\Contract\IOAwareInterface;
use Robo\LoadAllTasks;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * Base class for RD8 Robo commands.
 *
 * @package Lucacracco\RoboDrupal8\Robo
 */
class RoboDrupal8Tasks implements ConfigAwareInterface, LoggerAwareInterface, BuilderAwareInterface, IOAwareInterface, ContainerAwareInterface {

  use ContainerAwareTrait;
  use LoadAllTasks;
  use ConfigAwareTrait;
  use IO;
  use LoggerAwareTrait;

  //  use LoadTasks;

  /**
   * Writes an array to the screen as a formatted table.
   *
   * @param array $array
   *   The unformatted array.
   * @param array $headers
   *   The headers for the array. Defaults to ['Property','Value'].
   */
  protected function printArrayAsTable(
    array $array,
    array $headers = ['Property', 'Value']
  ) {
    $table = new Table($this->output);
    $table->setHeaders($headers)
      ->setRows(ArrayManipulator::convertArrayToFlatTextArray($array))
      ->render();
  }

  /**
   * The depth of command invocations, used by invokeCommands().
   *
   * E.g., this would be 1 if invokeCommands() called a method that itself
   * called invokeCommands().
   *
   * @var int
   */
  protected $invokeDepth = 0;

  /**
   * Invokes an array of Symfony commands.
   *
   * @param array $commands
   *   An array of Symfony commands to invoke. E.g., 'tests:behat'.
   */
  protected function invokeCommands(array $commands) {
    foreach ($commands as $key => $value) {
      if (is_numeric($key)) {
        $command = $value;
        $args = [];
      }
      else {
        $command = $key;
        $args = $value;
      }
      $this->invokeCommand($command, $args);
    }
  }

  /**
   * Invokes a single Symfony command.
   *
   * @param string $command_name
   *   The name of the command. E.g., 'tests:behat'.
   * @param array $args
   *   An array of arguments to pass to the command.
   *
   * @throws \Exception
   */
  protected function invokeCommand($command_name, array $args = []) {
    $this->invokeDepth++;

    /** @var \Lucacracco\RoboDrupal8\Robo\Application $application */
    $application = $this->getContainer()->get('application');
    $command = $application->find($command_name);

    $input = new ArrayInput($args);
    $prefix = str_repeat(">", $this->invokeDepth);
    $this->output->writeln("<comment>$prefix $command_name</comment>");
    $exit_code = $application->runCommand($command, $input, $this->output());
    $this->invokeDepth--;

    // The application will catch any exceptions thrown in the executed
    // command. We must check the exit code and throw our own exception. This
    // obviates the need to check the exit code of every invoked command.
    if ($exit_code) {
      throw new \Exception("Command `$command_name {$input->__toString()}` exited with code $exit_code.");
    }
  }

}