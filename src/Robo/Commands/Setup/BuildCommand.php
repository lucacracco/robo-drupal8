<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\Common\RandomString;
use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;

/**
 * Defines commands in the "setup:build" namespace.
 */
class BuildCommand extends RoboDrupal8Tasks {

  /**
   * Installs Drupal and sets correct file/directory permissions.
   *
   * @command setup:build:install
   *
   * @interactGenerateSettingsFiles
   *
   * @validateDrushConfig
   * @validateMySqlAvailable
   * @validateDocrootIsPresent
   */
  public function drupalInstall() {
    $commands = ['setup:install'];
    $commands[] = 'setup:config-import';
    $this->invokeCommands($commands);
    $this->setSitePermissions();
    $this->createDeployId(RandomString::string(8));
  }

  /**
   * Generates all required files for a full build.
   *
   * @command setup:build
   *
   * //interactConfigIdentical
   */
  public function build() {
    $this->invokeCommands([
      // setup:build:composer:install must run prior to setup:settings to ensure that
      // scaffold files are present.
      'setup:build:composer:install',
      // 'setup:settings',
      // 'frontend',
    ]);
  }

  /**
   * Installs Composer dependencies.
   *
   * @command setup:build:composer:install
   */
  public function composerInstall() {
    $result = $this->taskExec("export COMPOSER_EXIT_ON_PATCH_FAILURE=1; composer install --ansi --no-interaction")
      ->dir($this->getConfigValue('project.root'))
      ->detectInteractive()
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
      ->run();

    return $result;
  }

  /**
   * Creates deployment_identifier file.
   */
  protected function createDeployId($id) {
    $this->taskExecStack()->exec("echo '$id' > deployment_identifier")
      ->dir($this->getConfigValue('project.root'))
      ->stopOnFail()
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
      ->run();
  }

}