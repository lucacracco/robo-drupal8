<?php

namespace Lucacracco\Drupal8\Robo\Task\FileSystem;

use Lucacracco\Drupal8\Robo\Utility\PathResolver;

/**
 * Robo task: Ensure temporary files directory.
 */
class EnsureTemporaryFilesDirectory extends EnsureDirectorySkippedIfProduction {

  /**
   * {@inheritdoc}
   */
  protected function getPath() {
    return PathResolver::temporaryFilesDirectory();
  }

  /**
   * {@inheritdoc}
   */
  protected function skip() {
    return parent::skip() || $this->getPath() === sys_get_temp_dir();
  }

}
