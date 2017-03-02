<?php

namespace Lucacracco\Drupal8\Robo\Common;

use Lucacracco\Drupal8\Robo\Utility\DrupalCoreStatus;
use Lucacracco\Drupal8\Robo\Utility\PathResolver;

/**
 * A helper class for Drupal sites.
 */
trait Drupal {

  use CustomDrushStack;

  /**
   * Is installed?
   *
   * @return bool
   *   Whether Drupal is already installed or not.
   *
   * @throws \Exception
   */
  protected function isInstalled() {
    $status = $this->getSiteStatus();

    return static::statusIsBootstrapped($status);
  }

  /**
   * Return private files directory path.
   *
   * @return string|null
   *   The path to the private files directory of Drupal (if any).
   */
  protected function privateFilesDirectory() {
    $status = $this->getSiteStatus();
    $path = $status->get('private');

    if (!empty($path)) {
      return $path;
    }

    return NULL;
  }

  /**
   * Return public files directory path.
   *
   * @return string
   *   The path to the public files directory of Drupal.
   *
   * @throws \Exception
   */
  protected function publicFilesDirectory() {
    if (!static::isInstalled()) {
      return static::publicFilesDirectoryFallback();
    }

    $status = $this->getSiteStatus();;
    $path = $status->get('files');

    if (empty($path)) {
      throw new \Exception(__CLASS__ . ' - Unable to determine public files directory.');
    }

    return $path;
  }

  /**
   * Return temporary files directory path.
   *
   * @return string
   *   The path to the temporary files directory of Drupal.
   *
   * @throws \Exception
   */
  protected function temporaryFilesDirectory() {
    if (!static::isInstalled()) {
      // TODO: remove comment after update the function 'temporaryFilesDirectoryFallback'.
//      return static::temporaryFilesDirectoryFallback();
      throw new \Exception(__CLASS__ . ' - Site not installed.');
    }

    $status = $this->getSiteStatus();
    $path = $status->get('temp');

    if (empty($path)) {
      throw new \Exception(__CLASS__ . ' - Unable to determine temporary files directory.');
    }

    return $path;
  }

  /**
   * Return fallback public files directory path.
   *
   * This returns the default path of the public files directory.
   *
   * @return string
   *   The fallback path to the public files directory of Drupal.
   */
  protected function publicFilesDirectoryFallback() {
    return PathResolver::siteDirectory() . '/files';
  }

  /**
   * Return fallback temporary files directory path.
   *
   * This returns the default path of the temporary files directory.
   *
   * TODO: update!?
   *
   * @return string
   *   The fallback path to the temporary files directory of Drupal.
   *
   * @throws \Exception
   */
  protected function temporaryFilesDirectoryFallback() {
    $path = NULL;
    try {
      // Custom output capture to ensure no output at all.
      ob_start();

      $exec = $this->drushStack()
        ->argForNextCommand(escapeshellarg('return file_directory_os_temp();'))
        ->argForNextCommand('--format=string')
        ->drush('php-eval')
        ->run();

      // End custom output capture.
      ob_end_clean();

      if ($exec->wasSuccessful()) {
        $path = $exec->getMessage();
      }
    }
    catch (\Exception $e) {
    }

    if (!$path) {
      $path = ini_get('upload_tmp_dir');
    }

    if (!$path) {
      $path = sys_get_temp_dir();
    }

    if (!$path) {
      throw new \Exception(__CLASS__ . ' - Unable to determine fallback temporary files directory path.');
    }

    return $path;
  }

  /**
   * Get a information if Drupal Site is installed and bootstrap success.
   *
   * @param DrupalCoreStatus $status
   *   The Drupal core status information.
   *
   * @return bool
   *   Whether the status information indicate a successful bootstrap or not.
   */
  protected function statusIsBootstrapped(DrupalCoreStatus $status) {
    $bootstrap = $status->get('bootstrap');

    return !empty($bootstrap) && strtolower($bootstrap) === 'successful';
  }

  /**
   * Use CustomStackDrush for retrieve a status site.
   *
   * @return \Lucacracco\Drupal8\Robo\Utility\DrupalCoreStatus|mixed|null
   *
   * @throws \Exception
   */
  protected function getSiteStatus() {

    // Custom output capture to ensure no output at all.
    ob_start();

    // Use trait, if collectionBuilder isn't initialized, throw Robo exception.
    $output = $this->drushStack()
      ->argForNextCommand('--format=json')
      ->drush('core-status')
      ->run()
      ->getMessage();

    // End custom output capture.
    ob_end_clean();

    // Unable to parse Drupal core status JSON.
    if (!($status = @json_decode($output))) {

      // Print to debug?!
      print $output;
      throw new \Exception(__CLASS__ . ' - Unable to parse Drupal status.');
    }

    // Cast status.
    $status = new DrupalCoreStatus((object) $status);

    return $status;
  }

}
