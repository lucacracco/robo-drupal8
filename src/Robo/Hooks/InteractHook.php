<?php

namespace Lucacracco\RoboDrupal8\Robo\Hooks;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Consolidation\AnnotatedCommand\AnnotationData;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This class defines hooks that provide user interaction.
 *
 * These hooks typically use a Wizard to evaluate the validity of config or
 * state and guide the user toward resolving issues.
 */
class InteractHook extends RoboDrupal8Tasks {

  /**
   * Sets $this->input.
   */
  public function setInput(InputInterface $input) {
    $this->input = $input;
  }

  /**
   * Sets $this->output.
   */
  public function setOutput(OutputInterface $output) {
    $this->output = $output;
  }

  /**
   * Prompts user to confirm command.
   *
   * @hook interact @interactConfirmCommand
   */
  public function interactConfirmCommand(InputInterface $input, OutputInterface $output, AnnotationData $annotationData) {
    if (!$this->confirm("Confirm command?")) {
      throw new \Exception("Abort command.");
    }
  }

  /**
   * Prompts user to confirm overwrite of active config on rd8 setup.
   *
   * @hook interact @interactConfigIdentical
   */
  public function interactConfigIdentical(InputInterface $input, OutputInterface $output, AnnotationData $annotationData) {
    if (!$this->getInspector()->isActiveConfigIdentical()) {
      $this->logger->warning("The active configuration is not identical to the configuration in the export directory.");
      if (!$input->isInteractive()) {
        $this->logger->warning("Run `drush cex` to export the active config to the sync directory.");
      }
      $confirm = $this->confirm("Would you like to proceed anyway?");
      if (!$confirm) {
        throw new \Exception("The active configuration is not identical to the configuration in the export directory.");
      }
    }
  }

  /**
   * Prompts user to confirm overwrite installation.
   *
   * @hook interact @interactDrupalIsAlreadyInstalled
   */
  public function interactDrupalIsAlreadyInstalled(InputInterface $input, OutputInterface $output, AnnotationData $annotationData) {
    if ($this->getInspector()->isDrupalInstalled()) {
      if (!$this->confirm("Drupal is already installed. Continue?")) {
        throw  new \Exception("Abort.");
      }
    }
  }

}
