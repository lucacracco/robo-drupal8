<?php

namespace LucaCracco\Robo\Task\Drupal8;

use Symfony\Component\Yaml\Yaml;

trait LoadProperties {

  var $properties = [];
  var $pathProperties = "./build";
  var $environment = 'local';
  var $site = 'default';

  private function setEnvironment(string $environment = 'local') {
    $this->environment = $environment;
  }

  private function setSite(string $site = 'default') {
    $this->site = $site;
  }

  /**
   * @param string $pathProperties
   */
  private function setPathProperties(string $pathProperties) {
    $this->pathProperties = $pathProperties;
  }

  /**
   * @return array
   */
  private function getProperties() {
    $file_name = "build.$this->site.$this->environment.yml";
    $base_path = $this->pathProperties;
    $file_content = file_get_contents("$base_path/$file_name");
    $properties = Yaml::parse($file_content);

    /*
     * TODO: Validation properties.
     * checks if the required fields are present:
     * - environment
     * - drush_path
     * - domain
     * - database:url
     * - site-configuration:*
     * - account:*
     */

    return $properties;
  }
}