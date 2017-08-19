<?php

namespace Lucacracco\RoboDrupal8\Robo;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Application as ConsoleApplication;

/**
 * Class Application.
 *
 * @package Lucacracco\RoboDrupal8\Robo
 */
class Application extends ConsoleApplication {

  /**
   * This command is identical to its parent, but public rather than protected.
   */
  public function runCommand(Command $command, InputInterface $input, OutputInterface $output) {
    return $this->doRunCommand($command, $input, $output);
  }

  /**
   * @{inheritdoc}
   */
  protected function doRunCommand(Command $command, InputInterface $input, OutputInterface $output) {
    $exit_code = parent::doRunCommand($command, $input, $output);
    return $exit_code;
  }

}
