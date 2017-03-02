<?php

namespace Lucacracco\Drupal8\Robo\Task\FileSystem;

use Lucacracco\Drupal8\Robo\Utility\Environment;

/**
 * Robo task base: Ensure directory (skipped if in Production environment).
 */
abstract class EnsureDirectorySkippedIfProduction extends EnsureDirectory {

  /**
   * {@inheritdoc}
   */
  protected function skip() {
    return parent::skip() || Environment::isProduction($this->environment);
  }

}
