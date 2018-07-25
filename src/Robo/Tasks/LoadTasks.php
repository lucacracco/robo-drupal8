<?php

namespace Lucacracco\RoboDrupal8\Robo\Tasks;

/**
 * Custom Robo tasks.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Tasks
 */
trait LoadTasks {

  /**
   * Return Drush Task.
   *
   * @return \Lucacracco\RoboDrupal8\Robo\Tasks\DrushTask
   */
  protected function taskDrush() {
    /** @var \Lucacracco\RoboDrupal8\Robo\Tasks\DrushTask $task */
    $task = $this->task(DrushTask::class);
    $task->setInput($this->input());
    /** @var \Symfony\Component\Console\Output\OutputInterface $output */
    $output = $this->output();
    $task->setVerbosityThreshold($output->getVerbosity());
    return $task;
  }

}
