<?php

namespace Lucacracco\Drupal8\Robo\Utility;

use Lucacracco\Drupal8\Robo\Common\GlobalsCache;

/**
 * A helper class for configurations.
 *
 * @see https://packagist.org/packages/hassankhan/config
 */
class Configurations {

  use GlobalsCache;

  /**
   * Configuration object.
   *
   * @var \Noodlehaus\Config
   */
  protected $configurations;

  /**
   * Return configurations.
   *
   * @return \Noodlehaus\Config
   *   The configurations object.
   */
  public static function configurations() {
    return static::globalCacheVariable('__ROBO_DRUPAL8_CONFIG__');
  }

  /**
   * Get a single configuration in array.
   *
   * @param string $key
   *   Key of config.
   *
   * @param mixed|null $default_value
   *   Default value if not found.
   *
   * @return mixed|null
   */
  public static function get($key, $default_value = NULL) {
    $conf = static::globalCacheVariable('__ROBO_DRUPAL8_CONFIG__');
    return $conf->get($key, $default_value);
  }

  /**
   * Set a configuration.
   *
   * @param string $key
   *   Key of config field.
   * @param string $value
   *   A new value
   */
  public static function set($key, $value) {
    $conf = static::globalCacheVariable('__ROBO_DRUPAL8_CONFIG__');
    $conf->set($key, $value);
    static::globalCacheVariable('__ROBO_DRUPAL8_CONFIG__', $conf);
  }

  /**
   * Init configurations.
   *
   * Load from config_dir, validate configurations base and set in global cache.
   *
   * @param string $config_dir
   *   Path of directory.
   * @param array $configurations_override
   *   Configuration custom.
   */
  public static function init($config_dir, $configurations_override = []) {
    $configurations = static::loadConfiguration($config_dir, $configurations_override);
    static::validationConfiguration($configurations);
    static::globalCacheVariable('__ROBO_DRUPAL8_CONFIG__', $configurations);
  }

  /**
   * Load files configuration from directory.
   *
   * @param string|array $config_dir
   *   Path of directory.
   * @param array $configurations_override
   *   Configuration custom.
   *
   * @return \Noodlehaus\Config
   *
   * @throws \Exception
   */
  public static function loadConfiguration($config_dir, $configurations_override = []) {

    // Config object: load all files and merge.
    $config = new \Noodlehaus\Config($config_dir);

    // Override configurations.
    foreach ($configurations_override as $key => $value) {
      $config->set($key, $value);
    }

    return $config;
  }

  /**
   * Validation configuration.
   *
   * @param \Noodlehaus\Config $conf
   *   Configurations.
   *
   * @throws \Exception
   */
  public static function validationConfiguration($conf) {
    $keys = [
      'environment',
      'drush_path',
      'drupal_root_directory',
    ];
    foreach ($keys as $key) {
      if (!$conf->has($key)) {
        throw new \Exception("\"{$key}\" not found in configuration.");
      }
    }
  }

}
