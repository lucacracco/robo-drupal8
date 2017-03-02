<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

trait loadTasks {

  /**
   * Initialize site.
   *
   * @return Initialize
   */
  protected function taskSiteInitialize() {
    return $this->task(Initialize::class);
  }

  /**
   * Install site.
   *
   * @return Install
   */
  protected function taskSiteInstall() {
    return $this->task(Install::class);
  }

  /**
   * Enable/disable maintenance mode.
   *
   * @param bool $status
   *   Whether to enable or disable maintenance mode.
   *
   * @return MaintenanceMode
   */
  protected function taskSiteMaintenanceMode($status) {
    return $this->task(MaintenanceMode::class, $status);
  }

  /**
   * Set up file system.
   *
   * @return SetupFileSystem
   */
  protected function taskSiteSetupFileSystem() {
    return $this->task(SetupFileSystem::class);
  }

  /**
   * Update site.
   *
   * @return Update
   */
  protected function taskSiteUpdate() {
    return $this->task(Update::class);
  }

  /**
   * Status site.
   *
   * @return Status
   */
  protected function taskSiteStatus() {
    return $this->task(Status::class);
  }

  /**
   * Settings site.
   *
   * @return Settings
   */
  protected function taskSiteSettings() {
    return $this->task(Settings::class);
  }

}
