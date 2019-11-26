<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Composer;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;

/**
 * Defines commands in the "composer:*" namespace.
 */
class ComposerCommand extends RoboDrupal8Tasks {

  /**
   * Install packages.
   *
   * @command composer:install
   *
   * @option dev Whether package should be added to require-dev.
   * @option source Forces installation from package sources when possible,
   *   including VCS information.
   *
   * @return \Robo\Result
   */
  public function install($options = ['dev' => TRUE, 'source' => FALSE]) {
    $dev = $options['dev'] && $this->getConfigValue('composer.dev', TRUE);
    /** @var \Robo\Task\Composer\Install $task */
    $task = $this->taskComposerInstall()
      ->printOutput(TRUE)
      ->dir($this->getConfigValue('project.root'))
      ->dev($dev);
    if ($options['source']) {
      $task->preferSource();
    }
    return $task->run();
  }

  /**
   * Update packages.
   *
   * @command composer:update
   *
   * @option dev Whether package should be added to require-dev.
   * @option source Forces installation from package sources when possible,
   *   including VCS information.
   *
   * @return \Robo\Result
   */
  public function update($options = ['dev' => NULL, 'source' => FALSE]) {
    $dev = $options['dev'] && $this->getConfigValue('composer.dev', TRUE);
    /** @var \Robo\Task\Composer\Install $task */
    $task = $this->taskComposerInstall()
      ->printOutput(TRUE)
      ->dir($this->getConfigValue('project.root'))
      ->dev($dev);
    if ($options['source']) {
      $task->preferSource();
    }
    return $task->run();
  }

  /**
   * Requires a composer package.
   *
   * @command composer:require
   *
   * @param $package_name
   * @param $package_version
   *
   * @option dev Whether package should be added to require-dev.
   *
   * @return \Robo\Result
   * @throws \Exception
   */
  public function requirePackage($package_name, $package_version, $options = ['dev' => FALSE]) {
    $dev = $options['dev'] && $this->getConfigValue('composer.dev', TRUE);

    /** @var \Robo\Task\Composer\RequireDependency $task */
    $task = $this->taskComposerRequire()
      ->printOutput(TRUE)
      ->dir($this->getConfigValue('project.root'))
      ->dev($dev);
    if ($package_version) {
      $task->dependency($package_name, $package_version);
    }
    else {
      $task->dependency($package_name);
    }
    $result = $task->run();

    if (!$result->wasSuccessful()) {
      $this->logger->error("An error occurred while requiring {$package_name}.");
      $this->say("This is likely due to an incompatibility with your existing packages.");
      $confirm = $this->confirm("Should RoboDrupal8 attempt to update all of your Composer packages in order to find a compatible version?");
      if ($confirm) {
        $command = "composer require '{$package_name}:{$package_version}' --no-update ";
        if ($options['dev']) {
          $command .= "--dev ";
        }
        $command .= "&& composer update";
        $task = $this->taskExec($command)
          ->printOutput(TRUE)
          ->dir($this->getConfigValue('project.root'));
        $result = $task->run();
        if (!$result->wasSuccessful()) {
          throw new \Exception("Unable to install {$package_name} package.");
        }
      }
      else {
        // @todo Revert previous file changes.
        throw new \Exception("Unable to install {$package_name} package.");
      }
    }

    return $result;
  }

  /**
   * Validates root composer.json and composer.lock files.
   *
   * @command composer:validate
   */
  public function validate() {
    $this->say("Validating composer.json and composer.lock...");
    $result = $this->taskExecStack()
      ->dir($this->getConfigValue('project.root'))
      ->exec('composer validate --no-check-all --ansi')
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
      ->run();
    if (!$result->wasSuccessful()) {
      $this->say($result->getMessage());
      $this->logger->error("composer.lock is invalid.");
      $this->say("If this is simply a matter of the lock file being out of date, you may attempt to use `composer update --lock` to quickly generate a new hash in your lock file.");
      $this->say("Otherwise, `composer update` is likely necessary.");
      throw new \Exception("composer.lock is invalid!");
    }
    else {
      $this->say("Validation successful complete.");
    }
  }

}
