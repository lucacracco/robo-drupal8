<?php

namespace Lucacracco\Drupal8\Robo;

use Lucacracco\Drupal8\Robo\Utility\Environment;
use Lucacracco\Drupal8\Robo\Utility\PathResolver;
use Robo\Collection\Collection;
use Robo\Exception\TaskException;

/**
 * Console commands configuration base for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFileBase extends \Robo\Tasks {

  use \Robo\Task\Filesystem\loadShortcuts;
  use \Lucacracco\Drupal8\Robo\Common\Drupal;
  use \Lucacracco\Drupal8\Robo\Stack\loadTasks;
  use \Lucacracco\Drupal8\Robo\Task\Drush\loadTasks;
  use \Lucacracco\Drupal8\Robo\Task\Site\loadTasks;

  /**
   * Build a site from configurations dir.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function buildConf() {

    $collection = new Collection();

    // If installed, create dump.
    if ($this->isInstalled()) {
      $collection->add($this->taskDrushDumpExport(PathResolver::suggestionPathDump()));
    }

    // Build site.
    $collection->add($this->taskSiteInstall()->buildConf());

    // Create a url for login.
    $collection->add($this->taskDrushUserLogin(), 'UserLogin');

    return $collection;
  }

  /**
   * Build a site from configuration files using profile 'config_installer'.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function buildConfigInstaller() {

    $collection = new Collection();

    // If installed, create dump.
    if ($this->isInstalled()) {
      $collection->add($this->taskDatabaseDumpExport(PathResolver::suggestionPathDump()));
    }

    // TODO: update composer with config_installer.

    // Build site.
    $config_subdir = \Robo\Robo::config()->get('drupal.site.config_dir', NULL);
    if (!isset($config_subdir)) {
      throw new \InvalidArgumentException("Configuration dir not found.");
    }

    $collection->add($this->taskSiteInstall()
      ->buildConf(
        'config_installer',
        [
          "config_installer_sync_configure_form.sync_directory=\"{$config_subdir}\"",
        ]
      )
    );

    // Create a url for login.
    $collection->add($this->taskDrushUserLogin(), 'UserLogin');

    return $collection;
  }

  /**
   * Build an existing site by importing the database.
   *
   * @param array $opts Options.
   *   Options.
   * @option $dbname|d Database name
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function buildFromDatabase($opts = ['dbname|d' => NULL]) {
    $collection = new Collection();

    // If installed, create dump.
    if ($this->isInstalled()) {
      $collection->add($this->taskDatabaseDumpExport(PathResolver::suggestionPathDump()));
    }

    // Build site.
    $collection->add($this->taskSiteInstall()
      ->buildFromDatabase($opts['dbname']));

    // Create a url for login.
    $collection->add($this->taskDrushUserLogin(), 'UserLogin');

    return $collection;
  }

  /**
   * Build a new site.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function buildNew() {

    $collection = new Collection();

    // If installed, create dump.
    if ($this->isInstalled()) {
      $collection->add(
        $this->taskDatabaseDumpExport(PathResolver::suggestionPathDump()),
        'SqlDump'
      );
    }

    // Composer install for first time.
    $collection->add(
      $this->taskSiteInitialize(PathResolver::root(), Environment::needsBuild())
        ->composerInstall(),
      'composerInstall'
    );

    // Setup filesystem.
    $collection->add(
      $this->taskSiteSetupFileSystem(PathResolver::siteDirectory())
        ->clear()
        ->init(),
      'setupFileSystem'
    );

    // Install site.
    $collection->add(
      $this->taskDrushInstall()
        ->setSiteName("asd")
        ->build(), 'DrushInstall.buildNew'
    );

    $collection->add(
      $this->taskSiteSettings()->updateSettings(),
      'SiteSettings.configure'
    );

    $collection->add(
      $this->taskDrushSystemSiteUuid(Configurations::get('drupal.site.uuid')),
      'DrushSystemSiteUuid'
    );

    // Rebuild caches.
    $collection->add($this->taskDrushCacheRebuild(), 'Install.cacheRebuild');

    // Create a url for login.
    $collection->add($this->taskDrushUserLogin(), 'UserLogin');

    return $collection;
  }

  /**
   * Export configuration.
   *
   * Uninstall dev modules before export configuration and r-enable after if
   * not production environment.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function configurationExport() {
    $collection = new Collection();
    $modules_dev = \Robo\Robo::config()->get('drupal.site.modules_dev', []);
    $collection->add($this->taskDrushUninstallExtension($modules_dev));
    $collection->add($this->taskDrushCacheRebuild());
    $collection->add($this->taskDrushConfigExport());
    if (!Environment::isProduction()) {
      $collection->add($this->taskDrushEnableExtension($modules_dev));
    }
    return $collection;
  }

  /**
   * Import configuration.
   *
   * Uninstall dev modules before import configuration and r-enable after if
   * not production environment.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function configurationImport() {
    $collection = new Collection();
    $modules_dev = \Robo\Robo::config()->get('drupal.site.modules_dev', []);
    $collection->add($this->taskDrushUninstallExtension($modules_dev));
    $collection->add($this->taskDrushCacheRebuild());
    $collection->add($this->taskDrushConfigImport());
    if (!Environment::isProduction()) {
      $collection->add($this->taskDrushEnableExtension($modules_dev));
    }
    return $collection;
  }

  /**
   * Database export.
   *
   * @param string|null $file_path
   *   File path to save dump.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   *
   * @throws \Robo\Exception\TaskException
   */
  public function databaseExport($file_path = NULL) {
    $collection = new Collection();
    if (!$this->isInstalled()) {
      throw new TaskException($this, 'Site not installed.');
    }
    $file_path = isset($file_path) ? $file_path : PathResolver::suggestionPathDump();
    $collection->add($this->taskDrushCacheRebuild());
    $collection->add($this->taskDatabaseDumpExport($file_path));
    return $collection;
  }

  /**
   * Database import.
   *
   * @param string $file_path
   *   File .sql to load.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   *
   * @throws \Robo\Exception\TaskException
   *   If file not exist or drupal.
   */
  public function databaseImport($file_path) {
    $collection = new Collection();
    if (!$this->isInstalled()) {
      throw new TaskException($this, 'Site not installed.');
    }
    $collection->add($this->taskDatabaseDumpImport($file_path));
    $collection->add($this->taskDrushCacheRebuild());
    return $collection;
  }

  /**
   * Set site in maintenance.
   *
   * @param bool $mode
   *   Value of maintenance.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function siteMaintenanceMode($mode = TRUE) {
    $collection = new Collection();
    $collection->add($this->taskSiteMaintenanceMode($mode));
    $collection->add($this->taskDrushCacheRebuild());
    return $collection;
  }

  /**
   * Rebuild Cache.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function rebuildCache() {
    $collection = new Collection();
    $collection->add($this->taskDrushCacheRebuild());
    return $collection;
  }

  /**
   * User login.
   *
   * @param int $uid
   *   Drupal user id.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function siteUserLogin($uid = 1) {
    $collection = new Collection();
    $collection->add($this->taskDrushUserLogin($uid));
    return $collection;
  }

  /**
   * Update database pending of drupal.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function updateDatabase() {
    $collection = new Collection();
    $collection->add($this->taskDrushApplyDatabaseUpdates());
    $collection->add($this->taskDrushCacheRebuild());
    return $collection;
  }

  /**
   * Update Translations of drupal.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function updateTranslations() {
    $collection = new Collection();
    $collection->add($this->taskDrushLocaleUpdate());
    $collection->add($this->taskDrushCacheRebuild());
    return $collection;
  }

}
