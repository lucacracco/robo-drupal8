<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Rd8;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the 'config:*' namespace.
 */
class ConfigCommand extends RoboDrupal8Tasks {

  /**
   * Gets the value of a config variable.
   *
   * @command config:get
   *
   * @param string $key
   *   The key for the configuration item to get.
   */
  public function getValue($key) {
    if (!$this->getConfig()->has($key)) {
      throw new \InvalidArgumentException("$key is not set.");
    }

    $this->say($this->getConfigValue($key));
  }

  /**
   * Dumps all configuration values.
   *
   * @command config:dump
   */
  public function dump() {
    $config = $this->getConfig()->export();
    ksort($config);
    $this->printArrayAsTable($config);
  }

}
