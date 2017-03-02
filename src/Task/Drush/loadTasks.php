<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Class loadTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task\Drush
 */
trait loadTasks {

  /**
   * Apply database updates.
   *
   * @return ApplyDatabaseUpdates
   */
  protected function taskDrushApplyDatabaseUpdates() {
    return $this->task(ApplyDatabaseUpdates::class);
  }

  /**
   * Apply entity schema updates.
   *
   * @return ApplyEntitySchemaUpdates
   */
  protected function taskDrushEntitySchemaUpdates() {
    return $this->task(ApplyEntitySchemaUpdates::class);
  }

  /**
   * Rebuild caches.
   *
   * @return CacheRebuild
   */
  protected function taskDrushCacheRebuild() {
    return $this->task(CacheRebuild::class);
  }

  /**
   * Status site.
   *
   * @return Status
   */
  protected function taskDrushStatus() {
    return $this->task(Status::class);
  }

  /**
   * Import configuration.
   *
   * @return ConfigImport
   */
  protected function taskDrushConfigImport() {
    return $this->task(ConfigImport::class);
  }

  /**
   * Export configuration.
   *
   * @return ConfigExport
   */
  protected function taskDrushConfigExport() {
    return $this->task(ConfigExport::class);
  }

  /**
   * Enable extension(s).
   *
   * @param array $extensions
   *   An array of names for extensions to enable.
   *
   * @return EnableExtension
   */
  protected function taskDrushEnableExtension(array $extensions) {
    return $this->task(EnableExtension::class, $extensions);
  }

  /**
   * Uninstall extension(s).
   *
   * @param array $extensions
   *   An array of names for extensions to uninstall.
   *
   * @return UninstallExtension
   */
  protected function taskDrushUninstallExtension(array $extensions) {
    return $this->task(UninstallExtension::class, $extensions);
  }

  /**
   * Update localizations.
   *
   * @return LocaleUpdate
   */
  protected function taskDrushLocaleUpdate() {
    return $this->task(LocaleUpdate::class);
  }

  /**
   * Install Drupal site.
   *
   * @return Install
   */
  protected function taskDrushInstall() {
    return $this->task(Install::class);
  }

  /**
   * Drop all database tables.
   *
   * @return SqlDrop
   */
  protected function taskDrushSqlDrop() {
    return $this->task(SqlDrop::class);
  }

  /**
   * Set a state value.
   *
   * @param string $key
   *   The state key.
   * @param mixed $value
   *   The value to assign to the state key.
   * @param string $format
   *   The type for the value. Use 'auto' to detect format from value. Other
   *   recognized values are 'string', 'integer', 'float' or 'boolean' for
   *   corresponding primitive type, or 'json', 'yaml' for complex types.
   *
   * @return StateSet
   */
  protected function taskDrushStateSet($key, $value, $format = 'auto') {
    return $this->task(StateSet::class, $key, $value, $format);
  }

  /**
   * Display one-time login URL.
   *
   * @param int|string $user
   *   An optional uid, user name, or email address for the user to log in
   *   (defaults to user ID '1').
   *
   * @return UserLogin
   */
  protected function taskDrushUserLogin($user = 1) {
    return $this->task(UserLogin::class, $user);
  }

}
