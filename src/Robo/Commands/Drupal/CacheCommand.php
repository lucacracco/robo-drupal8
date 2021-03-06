<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "drupal:cache:*" namespaces.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Drupal
 */
class CacheCommand extends RoboDrupal8Tasks {

  /**
   * Cache rebuild of drupal.
   *
   * @command drupal:cache:rebuild
   * @aliases dcc
   *
   * @validateDrupalIsInstalled
   */
  public function cacheRebuild() {
    $this->taskDrush()
      ->drush('cache-rebuild')
      ->printOutput(TRUE)
      ->run();
  }

}
