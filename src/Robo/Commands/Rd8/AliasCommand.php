<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Rd8;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;

/**
 * Defines commands for installing and updating the RD8 alias.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Rd8
 */
class AliasCommand extends RoboDrupal8Tasks {

  /**
   * Installs the RD8 alias for command line usage.
   *
   * @command install-alias
   *
   * @throws \Exception
   */
  public function installRd8Alias() {
    if (!$this->getInspector()->isRd8AliasInstalled()) {
      $config_file = $this->getInspector()->getCliConfigFile();
      if (is_null($config_file)) {
        $this->logger->warning("Could not find your CLI configuration file.");
        $this->logger->warning("Looked in ~/.zsh, ~/.bash_profile, ~/.bashrc, ~/.profile, and ~/.functions.");
      }
      else {
        $this->say("RD8 can automatically create a Bash alias to make it easier to run Robo tasks.");
        $this->say("This alias will be created in <comment>$config_file</comment>.");
        $confirm = $this->confirm("Install alias?");
        if ($confirm) {
          $this->createNewAlias();
        }
      }
    }
    else {
      $config_file = $this->getInspector()->getCliConfigFile();
      $this->say("<info>The Rd8 alias is already installed in <comment>$config_file</comment>.</info>");
    }
  }

  /**
   * Creates a new RD8 alias in appropriate CLI config file.
   *
   * @throws \Exception
   */
  protected function createNewAlias() {
    $this->say("Installing <comment>rd8</comment> alias...");
    $config_file = $this->getInspector()->getCliConfigFile();
    if (is_null($config_file)) {
      $this->logger->error("Could not install rd8 alias. No profile found. Tried ~/.zshrc, ~/.bashrc, ~/.bash_profile, ~/.profile, and ~/.functions.");
    }
    else {
      $canonical_alias = file_get_contents($this->getConfigValue('rd8.root') . '/scripts/robo-drupal8/alias');
      $result = $this->taskWriteToFile($config_file)
        ->text($canonical_alias)
        ->append(TRUE)
        ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
        ->run();

      if (!$result->wasSuccessful()) {
        throw new \Exception("Unable to install RoboDrupal8 alias.");
      }

      $this->say("<info>Added alias for rd8 to $config_file.</info>");
      $this->say("You may now use the <comment>rd8</comment> command from anywhere within a RD8-generated repository.");
      $this->say("Restart your terminal session or run <comment>source $config_file</comment> to use the new command.");
    }
  }

}
