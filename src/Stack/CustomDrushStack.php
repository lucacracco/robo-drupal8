<?php

namespace Lucacracco\Drupal8\Robo\Stack;

use Boedah\Robo\Task\Drush\DrushStack;
use Robo\Exception\TaskException;
use Robo\Result;
use Symfony\Component\Process\Process;

/**
 * Class CustomDrushStack.
 *
 * Necessary to clean the commands executed.
 * Override function run(), see comment.
 *
 * @package Lucacracco\Drupal8\Robo\Stack
 */
class CustomDrushStack extends DrushStack {

  /**
   * Drupal site root.
   * We need to save this, since it needs to be the first argument.
   *
   * @var string
   */
  protected $drupalRoot;

  /**
   * Drupal site uri.
   * We need to save this, since it needs to be the first argument.
   *
   * @var string
   */
  protected $drupalUri;

  /**
   * {@inheritdoc}
   */
  public function drupalRootDirectory($drupalRootDirectory) {
    $this->printTaskInfo('Drupal root: <info>' . $drupalRootDirectory . '</info>');
    $this->drupalRoot = $drupalRootDirectory;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function uri($uri) {
    $this->printTaskInfo('URI: <info>' . $uri . '</info>');
    $this->drupalUri = $uri;
    return $this;
  }

  /**
   * Get Uri used.
   *
   * @return string
   */
  public function getUri() {
    return $this->drupalUri;
  }

  /**
   * Prepends site-alias, root, uri and appends arguments to the command.
   *
   * @param string $command
   * @param bool $assumeYes
   *
   * @return string the modified command string
   */
  protected function injectArguments($command, $assumeYes) {
    $cmd =
      $this->siteAlias . ' '
      . ($this->drupalRoot ? "-r {$this->drupalRoot} " : '')
      . ($this->drupalUri ? "-l {$this->drupalUri} " : '')
      . $command
      . ($assumeYes ? ' -y' : '')
      . $this->arguments
      . $this->argumentsForNextCommand;
    $this->argumentsForNextCommand = '';

    return $cmd;
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    if (empty($this->exec)) {
      throw new TaskException($this, 'You must add at least one command');
    }
    if (!$this->stopOnFail) {
//      $this->printTaskInfo('{command}', ['command' => $this->getCommand()]);
      $result = $this->executeCommand($this->getCommand());

      /*
       * Reset commands so as not to execute a command already previously done.
       */
//      $this->exec = [];
//      $this->arguments = '';

      return $result;
    }

    foreach ($this->exec as $command) {
      $this->printTaskInfo("Executing {command}", ['command' => $command]);
      $result = $this->executeCommand($command);
      if (!$result->wasSuccessful()) {
        return $result;
      }
    }

    return Result::success($this);
  }

  /**
   * Add an argument used in the next invocation of drush.
   *
   * {@inheritdoc}
   */
  public function argForNextCommand($arg) {
    return parent::argForNextCommand($arg);
  }

  /**
   * Add multiple arguments used in the next invocation of drush.
   *
   * {@inheritdoc}
   */
  public function argsForNextCommand($args) {
    return parent::argsForNextCommand($args);
  }

  /**
   * Pass option to executable used in the next invocation of drush.
   *
   * Options are prefixed with `--` , value can be provided in second parameter.
   * Option values are automatically escaped.
   *
   * {@inheritdoc}
   */
  public function optionForNextCommand($option, $value = NULL) {
    return parent::option($option, $value);
  }

  /**
   * Pass multiple options to executable used in the next invocation of drush.
   *
   * Value can be a string or array. Option values are automatically escaped.
   *
   * {@inheritdoc}
   */
  public function optionListForNextCommand($option, $value = []) {
    return parent::optionList($option, $value);
  }

  /**
   * @param string $command
   *
   * @return \Robo\Result
   */
  protected function executeCommand($command)
  {
    $process = new Process($command);
    $process->setTimeout(null);
    if ($this->workingDirectory) {
      $process->setWorkingDirectory($this->workingDirectory);
    }
    $this->getExecTimer()->start();
    if ($this->isPrinted) {
      $process->run(function ($type, $buffer) {
        print $buffer;
      });
    } else {
      $process->run();
    }
    $this->getExecTimer()->stop();

//    return new Result($this, $process->getExitCode(), $process->getOutput(), ['time' => $this->getExecTimer()->elapsed()]);
    return new Result($this, $process->getExitCode(), $process->getOutput());
  }

}
