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
    $task = $this->task(DrushTask::class);
    $task->setInput($this->input());

    return $task;
  }

}
