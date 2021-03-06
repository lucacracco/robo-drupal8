<?php

namespace Lucacracco\RoboDrupal8\Robo\Common;

use Lucacracco\RoboDrupal8\Robo\Config\ConfigAwareTrait;
use GuzzleHttp\Client;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Robo\Collection\CollectionBuilder;
use Robo\Common\IO;
use Robo\Contract\ConfigAwareInterface;
use Robo\Contract\IOAwareInterface;
use Robo\Contract\VerbosityThresholdInterface;
use Robo\Robo;
use Symfony\Component\Process\Process;

/**
 * A class for executing commands.
 *
 * This allows non-Robo-command classes to execute commands easily.
 */
class Executor implements ConfigAwareInterface, IOAwareInterface, LoggerAwareInterface {

  use ConfigAwareTrait;
  use IO;
  use LoggerAwareTrait;

  /**
   * A copy of the Robo builder.
   *
   * @var \Robo\Collection\CollectionBuilder|\Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks
   */
  protected $builder;

  /**
   * Executor constructor.
   *
   * @param \Robo\Collection\CollectionBuilder $builder
   *   This is a copy of the collection builder, required for calling various
   *   Robo tasks from non-command files.
   */
  public function __construct(CollectionBuilder $builder) {
    $this->builder = $builder;
  }

  /**
   * Returns $this->builder.
   *
   * @return \Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks
   *   The builder.
   */
  public function getBuilder() {
    return $this->builder;
  }

  /**
   * Wrapper for taskExec().
   *
   * @param string $command
   *   The command to execute.
   *
   * @return \Robo\Task\Base\Exec
   *   The task. You must call run() on this to execute it!
   */
  public function taskExec($command) {
    return $this->builder->taskExec($command);
  }

  /**
   * Executes a drush command.
   *
   * @param string $command
   *   The command to execute, without "drush" prefix.
   *
   * @return \Robo\Common\ProcessExecutor
   *   The unexecuted process.
   */
  public function drush($command) {
    // @todo Set to silent if verbosity is less than very verbose.
    $bin = $this->getConfigValue('composer.bin');
    /** @var \Robo\Common\ProcessExecutor $process_executor */
    $drush_alias = $this->getConfigValue('drush.alias');
    $command_string = "'$bin/drush' @$drush_alias $command";

    if ($this->input()->hasOption('yes') && $this->input()->getOption('yes')) {
      $command_string .= ' -y';
    }

    // URIs do not work on remote drush aliases in Drush 9. Instead, it is
    // expected that the alias define the uri in its configuration.
    if ($drush_alias != 'self') {
      $command_string .= ' --uri=' . $this->getConfigValue('site');
    }

    $process_executor = Robo::process(new Process($command_string));

    return $process_executor->dir($this->getConfigValue('project.docroot'))
      ->interactive(FALSE)
      ->printOutput(TRUE)
      ->printMetadata(TRUE)
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERY_VERBOSE);
  }

  /**
   * Executes a command.
   *
   * @param string $command
   *   The command.
   *
   * @return \Robo\Common\ProcessExecutor
   *   The unexecuted command.
   */
  public function execute($command) {
    /** @var \Robo\Common\ProcessExecutor $process_executor */
    $process_executor = Robo::process(new Process($command));
    return $process_executor->dir($this->getConfigValue('project.root'))
      ->printOutput(FALSE)
      ->printMetadata(FALSE)
      ->interactive(FALSE);
  }

}
