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
   * @return int
   *
   * @throws \Exception
   */
  public function requirePackage($package_name, $package_version) {

    $task = "composer require '{$package_name}''";
    if ($package_version) {
      $task = "composer require '{$package_name}:{$package_version}'";
    }

    $result = $this->taskExec($task)
      ->printOutput(TRUE)
      ->dir($this->getConfigValue('repo.root'))
      ->run();

    if (!$result->wasSuccessful()) {
//      $this->logger->error("An error occurred while requiring {$package_name}.");
      $this->say("This is likely due to an incompatibility with your existing packages.");
      $confirm = $this->confirm("Should BLT attempt to update all of your Composer packages in order to find a compatible version?");
      if ($confirm) {
        $result = $this->taskExec("composer require '{$package_name}:{$package_version}' --no-update && composer update")
          ->printOutput(TRUE)
          ->dir($this->getConfigValue('repo.root'))
          ->run();
        if (!$result->wasSuccessful()) {
          throw new \Exception("Unable to install {$package_name} package.");
        }
      }
      else {
        // @todo revert previous file chanages.
        throw new \Exception("Unable to install {$package_name} package.");
      }
    }

    return $result;
  }

}
