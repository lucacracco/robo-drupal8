<?php

namespace Lucacracco\Drupal8\Robo\Utility;

/**
 * A helper class for environments.
 */
class Environment {

  /**
   * Environment: local.
   */
  const LOCAL = 'local';

  /**
   * Environment: travis.
   */
  const TRAVIS = 'travis';

  /**
   * @var string Environment
   */
  private static $environment;

  /**
   * Sets the environment statically
   *
   * @param string $environment
   *  The environment
   */
  public static function set($environment) {
    self::$environment = $environment;
  }

  /**
   * Gets the statically saved environment
   *
   * @return string The environment
   */
  public static function get() {
    return Configurations::get('environment');
  }

  /**
   * Detect environment identifier from environment variable.
   *
   * @return string|null
   *   The environment identifier on success, otherwise NULL.
   */
  public static function detect() {
    $environment = getenv('VARIABLE_SITE_ENVIRONMENT');
    if ($environment !== NULL) {
      static::set($environment);
    }
    return $environment ?: NULL;
  }

  /**
   * Is Production environment?
   *
   * @param string $environment
   *   An environment string.
   *
   * @return bool
   *   Whether the environment is an production server or not.
   */
  public static function isProduction($environment) {
    return $environment && !in_array($environment, [
        static::LOCAL,
        static::TRAVIS
      ]);
  }

  /**
   * Is valid environment?
   *
   * @param string $environment
   *   An environment string.
   *
   * @return bool
   *   Whether the environment is valid or not.
   */
  public static function isValid($environment) {
    return $environment;
  }

  /**
   * Needs building?
   *
   * @param $environment
   *   An environment string.
   *
   * @return bool
   *   Whether the environment has to perform builds (e.g. run 'composer install').
   */
  public static function needsBuild($environment) {
    return static::isValid($environment) && !file_exists(PathResolver::root() . '/vendor/autoload.php');
  }

}
