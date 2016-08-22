<?php
namespace LucaCracco\Robo\Task\Drupal8;

trait TaskIO {

  use \Robo\Common\TaskIO;

  protected function printTaskWarning($text, $task = NULL) {
    $name = $this->getPrintedTaskName($task);
    $this->writeln(" <fg=white;bg=yellow;options=bold>[$name]</fg=white;bg=yellow;options=bold> $text");
  }
}
