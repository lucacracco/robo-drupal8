<?php

namespace Lucacracco\Drupal8\Robo\Task\FileSystem;

use Robo\Result;
use Robo\Task\BaseTask;
use Robo\Task\FileSystem\FilesystemStack;
use Lucacracco\Drupal8\Robo\Utility\Drupal;

/**
 * Robo task base: Ensure directory.
 */
abstract class EnsureDirectory extends BaseTask {

  /**
   * Environment.
   *
   * @var string
   */
  protected $environment;

  /**
   * Constructor.
   *
   * @param string $environment
   *   An environment string.
   */
  public function __construct($environment) {
    $this->environment = $environment;
  }

  /**
   * Return path to directory to ensure.
   *
   * @return string
   *   The directory path.
   */
  abstract protected function getPath();

  /**
   * Return mode of directory to ensure.
   *
   * @return int
   *   The (octal) mode.
   */
  protected function getMode() {
    return 0777;
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    $stack = new FilesystemStack();

    // Skip this task?
    if ($this->skip()) {
      return Result::success($this);
    }

    // Path is empty?
    if (!$this->getPath()) {
      throw new \Exception(get_class($this) . ' - No path specified.');
    }

    // Create directory (if not exists).
    if (!is_dir($this->getPath())) {
      $stack->mkdir($this->getPath());
    }

    // Make directory writable (if not already).
    if (!is_writable($this->getPath())) {
      $stack->chmod($this->getPath(), $this->getMode());
    }

    return $stack->run();
  }

  /**
   * Task should be skipped?
   *
   * @return bool
   *   Whether the task should be skipped or not?
   */
  protected function skip() {
    return !Drupal::isInstalled();
  }

}
