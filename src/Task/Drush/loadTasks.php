<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

use Robo\Config\Config;

/**
 * Class loadTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task\Drush
 */
trait loadTasks {

  /**
   * Apply database updates.
   *
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Drush\DrushTasks
   */
  protected function taskDrushApplyDatabaseUpdates(Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)->applyDatabaseUpdates();
  }

  /**
   * Apply entity schema updates.
   *
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return DrushTasks
   */
  protected function taskDrushEntitySchemaUpdates(Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)->applyEntitySchemaUpdates();
  }

  /**
   * Rebuild caches.
   *
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return DrushTasks
   */
  protected function taskDrushCacheRebuild(Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)->cacheRebuild();
  }

  /**
   * Status site.
   *
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return DrushTasks
   */
  protected function taskDrushCoreStatus(Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)->coreStatus();
  }

  /**
   * Import configuration.
   *
   * @param bool $partial
   * @param array $skip_modules
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Drush\DrushTasks
   */
  protected function taskDrushConfigImport($partial = FALSE, $skip_modules = [], Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)
      ->configImport($partial, $skip_modules);
  }

  /**
   * Export configuration.
   *
   * @param $destination
   * @param array $skip_modules
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return \Lucacracco\Drupal8\Robo\Task\Drush\DrushTasks
   */
  protected function taskDrushConfigExport($destination, $skip_modules = [], Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)
      ->configExport($destination, $skip_modules);
  }

  /**
   * Enable extension(s).
   *
   * @param array $extensions
   *   An array of names for extensions to enable.
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   *
   * @return DrushTasks
   */
  protected function taskDrushEnableExtension(array $extensions, Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)
      ->enableExtensions($extensions);
  }

  /**
   * Uninstall extension(s).
   *
   * @param array $extensions
   *   An array of names for extensions to uninstall.
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return DrushTasks
   */
  protected function taskDrushUninstallExtension(array $extensions, Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)
      ->uninstallExtensions($extensions);
  }

  /**
   * Update localizations.
   *
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return DrushTasks
   */
  protected function taskDrushLocaleUpdate(Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)->localeUpdate();
  }

  /**
   * Install Drupal site.
   *
   * @param $site_name
   * @param $site_mail
   * @param $account_mail
   * @param $account_name
   * @param $account_pass
   * @param $db_url
   * @param string $locale
   * @param string $site_sub_dir
   * @param string $profile
   * @param array $settings
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return DrushTasks
   */
  protected function taskDrushInstall($site_name, $site_mail, $account_mail, $account_name, $account_pass, $db_url, $locale = "en", $site_sub_dir = "default", $profile = "standard", $settings = [], Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)
      ->install($site_name, $site_mail, $account_mail, $account_name, $account_pass, $db_url, $locale, $site_sub_dir, $profile, $settings);
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
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return DrushTasks
   */
  protected function taskDrushStateSet($key, $value, $format = 'auto', Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)
      ->stateSet($key, $value, $format);
  }

  /**
   * Display one-time login URL.
   *
   * @param int|string $user
   *   An optional uid, user name, or email address for the user to log in
   *   (defaults to user ID '1').
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return DrushTasks
   */
  protected function taskDrushUserLogin($user = 1, Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)->userLogin($user);
  }

  /**
   * Export database dump.
   *
   * @param string $file_path
   *   The file path of the database dump.
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return DrushTasks
   */
  protected function taskDrushDumpExport($file_path, Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)->export($file_path);
  }

  /**
   * Import database dump.
   *
   * @param string $file_path
   *   The file path of the database dump.
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return DrushTasks
   */
  protected function taskDrushDumpImport($file_path, Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)->import($file_path);
  }

  /**
   * Set Config.
   *
   * @param string $config_name
   *   The config object name, for example "system.site".
   * @param string $key
   *   The config key, for example "page.front".
   * @param $value
   *    The value to assign to the config key. Use '-' to read from STDIN.
   *
   * @param \Robo\Config\Config|null $config
   *   The configurations contains path for drushPath, drupal root, and more..
   *
   * @return DrushTasks
   */
  protected function taskDrushConfigSet($config_name, $key, $value, Config $config = NULL) {
    return $this->task(DrushTasks::class, $config)
      ->configSet($config_name, $key, $value);
  }
}
