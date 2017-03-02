<?php

namespace Lucacracco\Drupal8\Robo\Task\FileSystem;

trait loadTasks {

  /**
   * Ensure private files directory.
   *
   * @param string $environment
   *   An environment string.
   *
   * @return EnsurePrivateFilesDirectory
   */
  protected function taskFileSystemEnsurePrivateFilesDirectory($environment) {
    return new EnsurePrivateFilesDirectory($environment);
  }

  /**
   * Ensure public files directory.
   *
   * @param string $environment
   *   An environment string.
   *
   * @return EnsurePublicFilesDirectory
   */
  protected function taskFileSystemEnsurePublicFilesDirectory($environment) {
    return new EnsurePublicFilesDirectory($environment);
  }

  /**
   * Ensure temporary files directory.
   *
   * @param string $environment
   *   An environment string.
   *
   * @return EnsureTemporaryFilesDirectory
   */
  protected function taskFileSystemEnsureTemporaryFilesDirectory($environment) {
    return new EnsureTemporaryFilesDirectory($environment);
  }

  /**
   * Ensure translation files directory.
   *
   * @param string $environment
   *   An environment string.
   *
   * @return EnsureTranslationFilesDirectory
   */
  protected function taskFileSystemEnsureTranslationFilesDirectory($environment) {
    return new EnsureTranslationFilesDirectory($environment);
  }

}
