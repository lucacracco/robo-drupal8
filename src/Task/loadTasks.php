<?php

namespace Lucacracco\Drupal8\Robo\Task;

use Robo\Config\Config;

/**
 * Class loadTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task
 */
trait loadTasks {

  /**
   * Tasks for manager the configurations.
   *
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\ConfigurationsTasks
   */
  protected function taskConfigurationsTasks(Config $config = NULL) {
    return $this->task(ConfigurationsTasks::class, $config);
  }

  /**
   * Tasks for manager the filesystem.
   *
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\InstallTasks
   */
  protected function taskInstallTasks(Config $config = NULL) {
    return $this->task(InstallTasks::class, $config);
  }

  /**
   * Tasks for manager the maintenance.
   *
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\MaintenanceTasks
   */
  protected function taskMaintenanceTasks(Config $config = NULL) {
    return $this->task(MaintenanceTasks::class, $config);
  }

}
