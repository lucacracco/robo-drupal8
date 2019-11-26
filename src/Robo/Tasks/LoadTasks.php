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
   * @return \Lucacracco\RoboDrupal8\Robo\Tasks\Drush
   */
  protected function taskDrush() {
    /** @var \Lucacracco\RoboDrupal8\Robo\Tasks\Drush $task */
    $task = $this->task(Drush::class);
    $task->setInput($this->input());
    /** @var \Symfony\Component\Console\Output\OutputInterface $output */
    $output = $this->output();
    $task->setVerbosityThreshold($output->getVerbosity());
    return $task;
  }

  /**
   * Load TwigRd8.
   *
   * @return \Lucacracco\RoboDrupal8\Robo\Tasks\TwigRd8
   */
  protected function taskTwigRd8() {
    return $this->task(TwigRd8::class);
  }

}
