<?php

namespace Lucacracco\RoboDrupal8\Robo\Config;

use Consolidation\Config\Loader\ConfigProcessor;
use Lucacracco\RoboDrupal8\Robo\Common\ArrayManipulator;

/**
 * Custom processor for YAML based configuration.
 *
 * The config processor combines multiple configuration files together, and
 * processes them as necessary.
 */
class YamlConfigProcessor extends ConfigProcessor {

  /**
   * Expand dot notated keys.
   *
   * @param array $config
   *   The configuration to be processed.
   *
   * @return array
   *   The processed configuration
   */
  protected function preprocess(array $config) {
    $config = ArrayManipulator::expandFromDotNotatedKeys(ArrayManipulator::flattenToDotNotatedKeys($config));
    return $config;
  }

}
