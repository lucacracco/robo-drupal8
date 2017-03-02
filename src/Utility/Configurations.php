<?php

namespace Lucacracco\Drupal8\Robo\Utility;

/**
 * A helper class for configurations.
 *
 * @see https://packagist.org/packages/hassankhan/config
 */
class Configurations {

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
    return static::configurationsCache();
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
    $conf = static::configurationsCache();
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
    $conf = static::configurationsCache();
    $conf->set($key, $value);
    static::configurationsCache($conf);
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
    static::configurationsCache($configurations);
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

  /**
   * Cache configurations in global variable.
   *
   * @param \Noodlehaus\Config $conf
   *   The config object to cache.
   *
   * @return \Noodlehaus\Config
   *   The cached configurations.
   *
   * @throws \Exception
   */
  protected static function configurationsCache($conf = NULL) {
    $cid = '__ROBO_DRUPAL8_CONFIG__';

    if (isset($conf) && !empty($conf)) {
      if (isset($GLOBALS[$cid]) && !empty($GLOBALS[$cid])) {
        throw new \Exception(__CLASS__ . ' - Is already initialized.');
      }

      $GLOBALS[$cid] = $conf;
    }

    if (!isset($GLOBALS[$cid]) || empty($GLOBALS[$cid])) {
      throw new \Exception(__CLASS__ . ' - Not initialized.');
    }

    return $GLOBALS[$cid];
  }

}
