<?php

namespace Lucacracco\Drupal8\Robo\Task\FileSystem;

use Lucacracco\Drupal8\Robo\Utility\PathResolver;

/**
 * Robo task: Ensure private files directory.
 */
class EnsurePrivateFilesDirectory extends EnsureDirectorySkippedIfProduction {

  /**
   * {@inheritdoc}
   */
  protected function getPath() {
    return PathResolver::privateFilesDirectory();
  }

  /**
   * {@inheritdoc}
   */
  protected function skip() {
    return parent::skip() || !$this->getPath();
  }

}
