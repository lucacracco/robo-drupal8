<?php

namespace Lucacracco\Drupal8\Robo\Common;

use Lucacracco\Drupal8\Robo\Utility\DrupalCoreStatus;

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
    return $this->statusIsBootstrapped($status);
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
