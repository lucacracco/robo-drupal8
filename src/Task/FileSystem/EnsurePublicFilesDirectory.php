<?php

namespace Lucacracco\Drupal8\Robo\Task\FileSystem;

use Lucacracco\Drupal8\Robo\Utility\PathResolver;

/**
 * Robo task: Ensure public files directory.
 */
class EnsurePublicFilesDirectory extends EnsureDirectorySkippedIfProduction {

  /**
   * {@inheritdoc}
   */
  protected function getPath() {
    return PathResolver::publicFilesDirectory();
  }

}
