<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Rd8;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Symfony\Component\Yaml\Yaml;

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

    $value = $this->getConfigValue($key);
    $value = is_array($value) ? $value : [$key => (string) $value];

    $this->printArrayAsTable($value);
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

  /**
   * Export all configurations values.
   *
   * @command config:export
   *
   * @option file File to save dump yaml configurations.
   */
  public function export($options = ['file' => '']) {
    $config = $this->getConfig()->export();
    ksort($config);
    $yaml = Yaml::dump($config, 8, 2);

    $this->say("Dump Yaml file:");

    $file_path = $options['file'];
    if (empty($file_path)) {
      $this->writeln($yaml);
    }
    else {
      file_put_contents($file_path, $yaml);
      $this->writeln($file_path);
    }
  }

}
