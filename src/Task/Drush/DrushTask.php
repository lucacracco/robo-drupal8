<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

use Lucacracco\Drupal8\Robo\Common\CustomDrushStack;
use Robo\Collection\Collection;
use Robo\Common\BuilderAwareTrait;
use Robo\Contract\BuilderAwareInterface;
use Robo\Result;
use Robo\Task\BaseTask;

/**
 * Robo task base: Drush.
 */
abstract class DrushTask extends BaseTask implements BuilderAwareInterface {

  use BuilderAwareTrait;
  use CustomDrushStack;

  /**
   * Collection Builder.
   *
   * @var \Robo\Collection\Collection
   */
  protected $collection;

  /**
   * DrushTask constructor.
   */
  public function __construct() {
    $this->collection = new Collection();
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    $this->printTaskInfo($this->getPrintedTaskName());
    // TODO: remove after complete "TODO" in \Robo\Collection\Collection:getCommand()
    if (count($this->collection->taskNames()) > 1) {
      $this->printTaskDebug("Command: getCommand() does not work on arbitrary collections of tasks.");
    }
    else {
      $this->printTaskDebug("Command: " . $this->collection->getCommand());
    }
    $this->startTimer();
    $return = $this->collection->run();
    $this->stopTimer();
    return new Result($this, $return->getExitCode(), $return->getOutputData(), ['time' => $this->getExecutionTime()]);
  }

}
