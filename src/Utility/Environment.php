<?php

namespace Lucacracco\Drupal8\Robo\Utility;

/**
 * A helper class for environments.
 */
class Environment {

  const ENVIRONMENT = "project.environment";
  const IS_PROD = "project.is_prod";
  const NEED_BUILD = "project.need_build";

  /**
   * Detect environment identifier from environment variable.
   *
   * @param string $variable_environment
   *   The variable to read from environment.
   *
   * @return null|string
   *   The environment identifier on success, otherwise NULL.
   */
  public static function detect($variable_environment = NULL) {
    return self::getFromEnvironment(self::ENVIRONMENT, $variable_environment);
  }

  /**
   * Gets the saved environment.
   *
   * @return string
   *   The environment.
   */
  public static function getEnvironment() {
    return static::detect();
  }

  /**
   * Is Production environment?
   *
   * @param string $variable_environment
   *   The variable to read from environment.
   *
   * @return bool
   *   Whether the environment is an production server or not.
   */
  public static function isProduction($variable_environment = NULL) {
    return self::getFromEnvironment(self::IS_PROD, $variable_environment);
  }

  /**
   * Needs building?
   *
   * @param string $variable_environment
   *   The variable to read from environment.
   *
   * @return bool
   *   Whether the environment has to perform builds (e.g. run 'composer install').
   */
  public static function needsBuild($variable_environment = NULL) {
    return self::getFromEnvironment(self::NEED_BUILD, $variable_environment);
  }

  /**
   * Search and retrieve data ENVIRONMENT VARIABLES (use getenv()) or CONFIGURATION FILE.
   *
   * @param $name
   * @param $variable_environment
   *
   * @return mixed|null|string
   */
  protected static function getFromEnvironment($name, $variable_environment = NULL) {

    if (isset($variable_environment)) {
      $value_found = getenv($variable_environment);
      if (isset($value_found)) {
        return $value_found;
      }
    }

    return \Robo\Robo::config()->get($name, NULL);
  }

}
