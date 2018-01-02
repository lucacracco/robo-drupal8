<?php

namespace Lucacracco\RoboDrupal8\Robo\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;
use Symfony\Component\Finder\Finder;

/**
 * Defines commands in the "setup:build" namespace.
 */
class BuildCommand extends RoboDrupal8Tasks {

  /**
   * Installs Drupal and sets correct file/directory permissions.
   *
   * @command setup:drupal:install
   *
   * @interactGenerateSettingsFiles
   *
   * @validateDrushConfig
   * @validateMySqlAvailable
   * @validateDocrootIsPresent
   */
  public function drupalInstall() {
    $commands = ['internal:drupal:install'];
    $commands[] = 'setup:config-import';
    $this->invokeCommands($commands);
    $this->setSitePermissions();
    $this->createDeployId(RandomString::string(8));
  }

  /**
   * Creates deployment_identifier file.
   */
  protected function createDeployId($id) {
    $this->taskExecStack()->exec("echo '$id' > deployment_identifier")
      ->dir($this->getConfigValue('repo.root'))
      ->stopOnFail()
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
      ->run();
  }

  /**
   * Set correct permissions for files and folders in docroot/sites/*.
   */
  protected function setSitePermissions() {
    $taskFilesystemStack = $this->taskFilesystemStack();
    $multisite_dir = $this->getConfigValue('docroot') . '/sites/' . $this->getConfigValue('site');
    $finder = new Finder();
    $dirs = $finder
      ->in($multisite_dir)
      ->directories()
      ->depth('< 1')
      ->exclude('files');
    foreach ($dirs->getIterator() as $dir) {
      $taskFilesystemStack->chmod($dir->getRealPath(), 0755);
    }
    $files = $finder
      ->in($multisite_dir)
      ->files()
      ->depth('< 1')
      ->exclude('files');
    foreach ($files->getIterator() as $dir) {
      $taskFilesystemStack->chmod($dir->getRealPath(), 0644);
    }

    $taskFilesystemStack->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE);
    $result = $taskFilesystemStack->run();

    if (!$result->wasSuccessful()) {
      throw new \Exception("Unable to set permissions for site directories.");
    }
  }

  /**
   * Generates all required files for a full build.
   *
   * @command setup:build
   *
   * @interactConfigIdentical
   */
  public function build() {
    $this->invokeCommands([
      // setup:composer:install must run prior to setup:settings to ensure that
      // scaffold files are present.
      'setup:composer:install',
      'setup:git-hooks',
      'setup:settings',
      'frontend',
    ]);

    $this->invokeHook("post-setup-build");
  }

  /**
   * Installs Composer dependencies.
   *
   * @command setup:composer:install
   */
  public function composerInstall() {
    $result = $this->taskExec("export COMPOSER_EXIT_ON_PATCH_FAILURE=1; composer install --ansi --no-interaction")
      ->dir($this->getConfigValue('repo.root'))
      ->detectInteractive()
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
      ->run();

    return $result;
  }

}