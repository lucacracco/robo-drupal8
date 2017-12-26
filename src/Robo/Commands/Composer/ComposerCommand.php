<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Composer;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "composer:*" namespace.
 */
class ComposerCommand extends RoboDrupal8Tasks {

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

    /** @var \Robo\Task\Composer\RequireDependency $task */
    $task = $this->taskComposerRequire()
      ->printOutput(TRUE)
      ->dir($this->getConfigValue('repo.root'));
    if ($options['dev']) {
      $task->dev(TRUE);
    }
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
      $confirm = $this->confirm("Should BLT attempt to update all of your Composer packages in order to find a compatible version?");
      if ($confirm) {
        $command = "composer require '{$package_name}:{$package_version}' --no-update ";
        if ($options['dev']) {
          $command .= "--dev ";
        }
        $command .= "&& composer update";
        $task = $this->taskExec($command)
          ->printOutput(TRUE)
          ->dir($this->getConfigValue('repo.root'));
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

}
