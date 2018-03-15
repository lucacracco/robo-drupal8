<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;
use Symfony\Component\Finder\Finder;

/**
 * Defines commands in the "drupal:filesystem:protect-site" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Drupal
 */
class FilesystemCommand extends RoboDrupal8Tasks {

  /**
   * Set correct permissions for files and folders in docroot/sites/*.
   *
   * @command drupal:filesystem:protect-site
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

  /**
   * Clear files and folders in ./sites/[site]/*.
   *
   * @command drupal:filesystem:clear
   */
  public function clearSite() {
    $taskFilesystemStack = $this->taskFilesystemStack();
    $site_dir = $this->getConfigValue('docroot') . '/sites/' . $this->getConfigValue('site');

    // Chmod all files.
    $task_remove_files = $taskFilesystemStack
      ->chmod($site_dir, 0775, 0000, TRUE);

    $map_files_to_remove = [
      $site_dir . DIRECTORY_SEPARATOR . 'settings.php',
      $site_dir . DIRECTORY_SEPARATOR . 'settings.local.php',
      $site_dir . DIRECTORY_SEPARATOR . 'services.yml',
    ];

    foreach ($map_files_to_remove as $to_remove) {
      if (file_exists($to_remove)) {
        $task_remove_files->remove($to_remove);
      }
    }
    $result = $task_remove_files->run();

    if (!$result->wasSuccessful()) {
      throw new \Exception("Unable to delete files and folders: " . $result->getMessage());
    }
    $this->say("Clear files and folder.");

  }

}
