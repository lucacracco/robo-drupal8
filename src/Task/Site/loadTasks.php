<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

use Lucacracco\Drupal8\Robo\Config;

trait loadTasks {

  /**
   * Initialize site.
   *
   * @param string $dir
   *   Directory to found composer.json.
   * @param \Lucacracco\Drupal8\Robo\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Site\SiteTasks
   */
  protected function taskSiteComposerInstall($dir, Config $config = NULL) {
    return $this->task(SiteTasks::class, $config)->composerInstall($dir);
  }

  /**
   * Install new site.
   *
   * @param array $settings
   *   Contains settings to include in installation.
   * @param \Lucacracco\Drupal8\Robo\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Site\SiteTasks
   */
  protected function taskSiteBuildNew($settings = [], Config $config = NULL) {
    return $this->task(SiteTasks::class, $config)->buildNew($settings);
  }

  /**
   * Install from configurations directory.
   *
   * @param array $settings
   *   Contains settings to include in installation.
   * @param \Lucacracco\Drupal8\Robo\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Site\SiteTasks
   */
  protected function taskSiteBuildConf($settings = [], Config $config = NULL) {
    return $this->task(SiteTasks::class, $config)->buildConf($settings);
  }

  /**
   * Install from configurations directory used 'config_installer'.
   *
   * @param array $settings
   *   Contains settings to include in installation.
   * @param \Lucacracco\Drupal8\Robo\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Site\SiteTasks
   */
  protected function taskSiteBuildConfigInstaller($settings = [], Config $config = NULL) {
    return $this->task(SiteTasks::class, $config)
      ->buildConfigInstaller($settings);
  }

  /**
   * Install from configurations directory used 'config_installer'.
   *
   * @param string $dump
   *   Path of dump to load.
   * @param array $settings
   *   Contains settings to include in installation.
   * @param \Lucacracco\Drupal8\Robo\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Site\SiteTasks
   */
  protected function taskSiteBuildFromDatabase($dump, $settings = [], Config $config = NULL) {
    return $this->task(SiteTasks::class, $config)
      ->buildFromDatabase($dump, $settings);
  }

  /**
   * Enable/disable maintenance mode.
   *
   * @param bool $status
   *   Whether to enable or disable maintenance mode.
   * @param \Lucacracco\Drupal8\Robo\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Site\SiteTasks
   */
  protected function taskSiteMaintenanceMode($status, Config $config = NULL) {
    return $this->task(SiteTasks::class, $config)->maintenanceMode($status);
  }

  /**
   * Update site.
   *
   * @param \Lucacracco\Drupal8\Robo\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Site\SiteTasks
   */
  protected function taskSiteUpdate(Config $config = NULL) {
    return $this->task(SiteTasks::class, $config)->updateAll();
  }

  /**
   * Status site.
   *
   * @param \Lucacracco\Drupal8\Robo\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Site\SiteTasks
   */
  protected function taskSiteStatus(Config $config = NULL) {
    return $this->task(SiteTasks::class, $config)->status();
  }

  /**
   * Settings site.
   *
   * @param \Lucacracco\Drupal8\Robo\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Site\SiteTasks
   */
  protected function taskSiteUpdateSettings(Config $config) {
    return $this->task(SiteTasks::class, $config)->updateSettings();
  }

}
