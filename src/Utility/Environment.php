<?php

namespace Lucacracco\Drupal8\Robo\Utility;

use Lucacracco\Drupal8\Robo\Common\GlobalsCache;

/**
 * A helper class for environments.
 */
class Environment {

  const ENVIRONMENT = "__ENVIRONMENT__";
  const IS_PROD = "__IS_PRODUCTION__";
  const NEED_BUILD = "__NEED_BUILD__";

  use GlobalsCache;

  /**
   * Sets the environment.
   *
   * @param string $environment
   *  The environment.
   */
  public static function setEnvironment($environment) {
    static::globalCacheVariable(self::ENVIRONMENT, $environment);
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
   * Sets production variable.
   *
   * @param boolean $production
   *  The environment.
   */
  public static function setProduction($production) {
    static::globalCacheVariable(self::IS_PROD, ($production) ? 'true' : 'false');
  }

  /**
   * Sets need build  variable.
   *
   * @param boolean $need_build
   *  The environment.
   */
  public static function setNeedBuild($need_build) {
    static::globalCacheVariable(self::NEED_BUILD, ($need_build) ? 'true' : 'false');
  }

  /**
   * Detect environment identifier from environment variable.
   *
   * @param string $variable_environment
   *   The variable to read for detect environment.
   *
   * @return null|string
   *   The environment identifier on success, otherwise NULL.
   */
  public static function detect($variable_environment = 'VARIABLE_SITE_ENVIRONMENT') {
    return self::getFromAll(self::ENVIRONMENT, 'no-environment-set', $variable_environment);
  }

  /**
   * Is Production environment?
   *
   * @return bool
   *   Whether the environment is an production server or not.
   */
  public static function isProduction() {
    return self::getFromAll(self::IS_PROD, FALSE);
  }

  /**
   * Needs building?
   *
   * @return bool
   *   Whether the environment has to perform builds (e.g. run 'composer install').
   */
  public static function needsBuild() {
    return self::getFromAll(self::NEED_BUILD, FALSE);
  }

  /**
   * Search and retrieve data from GLOBALS, ENVIRONMENT VARIABLES, CONFIGURATION FILE.
   *
   * @param $name
   * @param null $default_return
   * @return mixed|null|string
   */
  protected static function getFromAll($name, $default_return = NULL, $variable_environment = NULL) {

    if (isset($GLOBALS[$name]) && !empty($GLOBALS[$name])) {
      return $GLOBALS[$name];
    }
    elseif ($env = getenv($name) && !isset($variable_environment)) {
      return $env;
    }
    elseif (isset($variable_environment) && $env = getenv($variable_environment)) {
      return $env;
    }
    elseif ($conf = Configurations::get($name, FALSE)) {
      return $conf;
    }
    else {
      return $default_return;
    }
  }

}
