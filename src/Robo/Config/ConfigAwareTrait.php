<?php

namespace Lucacracco\RoboDrupal8\Robo\Config;

use Robo\Common\ConfigAwareTrait as RoboConfigAwareTrait;

/**
 * Adds custom methods to RoboConfigAwareTrait.
 */
trait ConfigAwareTrait {

  use RoboConfigAwareTrait;

  /**
   * Gets a config value for a given key.
   *
   * @param string $key
   *   The config key.
   * @param mixed|null $default
   *   The default value if the key does not exist in config.
   *
   * @return mixed|null
   *   The config value, or else the default value if they key does not exist.
   */
  protected function getConfigValue($key, $default = NULL) {
    if (!$this->getConfig()) {
      return $default;
    }
    return $this->getConfig()->get($key, $default);
  }

  /**
   * Gets a config value for a given key.
   *
   * @param string $key
   *   The config key.
   * @param mixed|null $default
   *   The default value if the key does not exist in config.
   *
   * @return mixed|null
   *   The config value, or else the default value if they key does not exist
   *   or empty.
   */
  protected function getConfigValueIfNotEmpty($key, $default = NULL) {
    $value = $this->getConfigValue($key);
    return empty($value) ? $default : $value;
  }

  /**
   * Check if configuration exist.
   *
   * @param string $key
   *
   * @return boolean
   *   True if configuration has key.
   */
  protected function hasConfigValue($key) {
    if (!$this->getConfig()) {
      throw new \InvalidArgumentException("Configuration required.");
    }
    return $this->getConfig()->has($key);
  }

  /**
   * Set a value in configuration.
   *
   * @param string $key
   * @param string $value
   *
   * @throws \Exception
   */
  protected function setConfigValue($key, $value) {
    if (!$this->getConfig()) {
      throw new \Exception("Not possible set config value.");
    }
    $this->getConfig()->set($key, $value);
  }

}
