<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

use Robo\Collection\Collection;
use Robo\Common\BuilderAwareTrait;
use Robo\Common\TaskIO;
use Robo\Common\Timer;
use Robo\Contract\BuilderAwareInterface;
use Robo\Result;
use Robo\Task\BaseTask;

/**
 * Robo task base: Site.
 *
 * @package Lucacracco\Drupal8\Robo\Task
 */
abstract class SiteTask extends BaseTask implements BuilderAwareInterface {

  use BuilderAwareTrait;
  use TaskIO;
  use Timer;
  use \Robo\Task\Filesystem\loadShortcuts;

  /**
   * Collection Builder.
   *
   * @var \Robo\Collection\Collection
   */
  protected $collection;

  /**
   * SiteTask constructor.
   *
   * Init collection and check configurations.
   */
  public function __construct() {
    $this->collection = new Collection();

    // Configuration validation.
    if (!$this->configurationValid()) {
      throw new \InvalidArgumentException(get_class($this) . ' - Configurations not valid');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    $this->printTaskInfo($this->getPrintedTaskName());
    $this->startTimer();
    $return = $this->collection->run();
    $this->stopTimer();
    return new Result($this, $return->getExitCode(), $return->getOutputData(), ['time' => $this->getExecutionTime()]);
  }

  /**
   * Function to check configuration.
   *
   * @return bool
   */
  protected function configurationValid() {
    return TRUE;
  }

}
