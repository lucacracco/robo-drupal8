<?php

namespace LucaCracco\Robo\Task\Drupal8;

trait loadTasks {

  /**
   * Retrieve a Drupal8Stack.
   *
   * @param string $environment
   *   Environment variable (local|stage|prod|custom1|..).
   * @param string $sub_dir
   *   Match to the sites that you want to start, useful for multi-site.
   *   In the case of a single installation to use/leave 'default'.
   *   Site (default|example1|..).
   * @param string $path_properties
   *   Absolute path where to find the configuration files.
   *
   * @return \LucaCracco\Robo\Task\Drupal8\Drupal8Stack
   *   Object Drupal8Stack.
   */
  protected function taskDrupal8Stack($environment = 'local', $sub_dir = 'default', $path_properties = 'build') {
    return new Drupal8Stack($environment, $sub_dir, $path_properties);
  }

  /**
   * Retrieve a Drupal8Functionality.
   *
   * @param string $environment
   *   Environment variable (local|stage|prod|custom1|..).
   * @param string $sub_dir
   *   Match to the sites that you want to start, useful for multi-site.
   *   In the case of a single installation to use/leave 'default'.
   *   Site (default|example1|..).
   * @param string $path_properties
   *   Absolute path where to find the configuration files.
   *
   * @return \LucaCracco\Robo\Task\Drupal8\Drupal8Functionality
   *   Object Drupal8Functionality.
   */
  protected function taskDrupal8Functionality($environment = 'local', $sub_dir = 'default', $path_properties = 'build') {
    return new Drupal8Functionality($environment, $sub_dir, $path_properties);
  }

}