<?php

namespace Lucacracco\Drupal8\Robo;

use \Robo\Config\Config as RoboConfig;

/**
 * Class Config custom.
 *
 * @package Project\Robo
 */
class Config extends RoboConfig {

  const DEFAULT_PROGRESS_DELAY = 180;

  // URI of the drupal site to use
  const URI_DRUPAL_SITE = 'site';
  const URI_DRUPAL_SITE_USE = 'default';

  /**
   * Return an associative array containing all of the global configuration
   * options and their default values.
   *
   * @return array
   */
  public function getGlobalOptionDefaultValues() {
    $globalOptions = parent::getGlobalOptionDefaultValues();
    $globalOptions[self::URI_DRUPAL_SITE] = self::URI_DRUPAL_SITE_USE;
    return $globalOptions;
  }

}