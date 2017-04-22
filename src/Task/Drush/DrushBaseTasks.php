<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

use Lucacracco\Drupal8\Robo\Common\CustomDrushStack;
use Lucacracco\Drupal8\Robo\Config;
use Robo\Collection\Collection;
use Robo\Common\BuilderAwareTrait;
use Robo\Contract\BuilderAwareInterface;
use Robo\Result;
use Robo\Task\BaseTask;

/**
 * Class DrushBaseTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task\Drush
 */
abstract class DrushBaseTasks extends BaseTask implements BuilderAwareInterface {

  use BuilderAwareTrait;
  use CustomDrushStack;

  /**
   * Collection Builder.
   *
   * @var \Robo\Collection\Collection
   */
  protected $collection;

  /**
   * Config Object.
   *
   * @var \Lucacracco\Drupal8\Robo\Config
   */
  protected $config;

  /**
   * DrushTasks constructor.
   *
   * @param \Lucacracco\Drupal8\Robo\Config|NULL $config
   *  If null load \Robo\Robo::config().
   */
  public function __construct(Config $config = NULL) {
    $this->config = isset($config) ? $config : \Robo\Robo::config();
    $this->collection = new Collection();

    // Config validation.
    if (!$this->configurationValid()) {
      throw new \InvalidArgumentException(get_class($this) . ': Configurations not valid.');
    }
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

  /**
   * Function to check configurations.
   *
   * @return bool
   */
  protected function configurationValid() {
    return $this->config->has('project.drush_path') && $this->config->has('drupal.root');
  }

}