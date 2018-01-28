<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;
use Symfony\Component\Finder\Finder;

/**
 * Defines commands in the "drupal:protect-site" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Drupal
 */
class ProtectSiteCommand extends RoboDrupal8Tasks {

  /**
   * Set correct permissions for files and folders in docroot/sites/*.
   *
   * @command drupal:protect-site
   */
  public function protectSite() {
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

}
