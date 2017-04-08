<?php

namespace Lucacracco\Drupal8\Robo;

use Lucacracco\Drupal8\Robo\Utility\Configurations;
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

  use \Lucacracco\Drupal8\Robo\Common\Drupal;
  use \Robo\Task\Filesystem\loadShortcuts;
  use \Lucacracco\Drupal8\Robo\Task\DatabaseDump\loadTasks;
  use \Lucacracco\Drupal8\Robo\Task\Drush\loadTasks;
  use \Lucacracco\Drupal8\Robo\Stack\loadTasks;
  use \Lucacracco\Drupal8\Robo\Task\Site\loadTasks;

  /**
   * Options arguments for command line.
   */
  const OPTS = [
    'site|s' => 'default',
  ];

  /**
   * Init configuration file.
   *
   * @param string $site
   */
  protected function init($site = 'default') {
    // Initialize path base.
    PathResolver::init('.');

    // Initialize configurations for Drupal8 project.
    Configurations::init(
      [
        PathResolver::root() . "/build/{$site}.yml.dist",
        '?' . PathResolver::root() . "/build/{$site}.yml",
      ]
    );

    // Save environment indication.
    Environment::setEnvironment(Configurations::get("project.environment"));
  }

  /**
   * Build a site from configurations dir.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function buildConf($opts = self::OPTS) {
    $this->init($opts['site']);

    $collection = new Collection();

    // If installed, create dump.
    if ($this->isInstalled()) {
      $collection->add($this->taskDatabaseDumpExport($this->getPathDump()));
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
  public function buildConfigInstaller($opts = self::OPTS) {
    $this->init($opts['site']);

    $collection = new Collection();

    // If installed, create dump.
    if ($this->isInstalled()) {
      $collection->add($this->taskDatabaseDumpExport($this->getPathDump()));
    }

    // TODO: check profile is found.

    // Build site.
    $config_subdir = Configurations::get('drupal.site.config_dir');
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
      $collection->add($this->taskDatabaseDumpExport($this->getPathDump()));
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
  public function buildNew($opts = self::OPTS) {
    $this->init($opts['site']);

    $collection = new Collection();

    // If installed, create dump.
    if ($this->isInstalled()) {
      $collection->add($this->taskDatabaseDumpExport($this->getPathDump()));
    }

    // Build new site.
    $collection->add($this->taskSiteInstall()->buildNew());

    // Create a url for login.
    $collection->add($this->taskDrushUserLogin(), 'UserLogin');

    return $collection;
  }

  /**
   * Export configuration.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function configurationExport($opts = self::OPTS) {
    $this->init($opts['site']);
    $collection = new Collection();
    $modules_dev = Configurations::get('drupal.site.modules_dev');
    $collection->add($this->taskDrushUninstallExtension($modules_dev));
    $collection->add($this->taskDrushCacheRebuild());
    $collection->add($this->taskDrushConfigExport());
    $collection->add($this->taskDrushEnableExtension($modules_dev));
    return $collection;
  }

  /**
   * Import configuration.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function configurationImport($opts = self::OPTS) {
    $this->init($opts['site']);
    $collection = new Collection();
    $modules_dev = Configurations::get('drupal.site.modules_dev');
    $collection->add($this->taskDrushUninstallExtension($modules_dev));
    $collection->add($this->taskDrushCacheRebuild());
    $collection->add($this->taskDrushConfigImport());
    $collection->add($this->taskDrushEnableExtension($modules_dev));
    return $collection;
  }

  /**
   * Database export.
   *
   * @param string $file_path
   *   File path to save dump.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   *
   * @throws \Robo\Exception\TaskException
   */
  public function databaseExport($file_path) {
    $collection = new Collection();
    if (!$this->isInstalled()) {
      throw new TaskException($this, 'Site not installed.');
    }
    $file_path = isset($file_path) ?: $this->getPathDump();
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
    $file_path = isset($file_path) ?: $this->getPathDump();
    $collection->add($this->taskDatabaseDumpImport($file_path));
    $collection->add($this->taskDrushCacheRebuild());
    return $collection;
  }

  /**
   * Clear all search indexes and mark them for reindexing.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   *
   * @throws \Robo\Exception\TaskException
   */
  public function searchapiClear() {
    throw new TaskException($this, 'Not yet implemented');
  }

  /**
   * Index items for all enabled search indexes.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   *
   * @throws \Robo\Exception\TaskException
   */
  public function searchapiIndex() {
    throw new TaskException($this, 'Not yet implemented');
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
    return $collection;
  }

  /**
   * Rebuild Cache.
   *
   * @return \Robo\Collection\Collection
   *   The command collection.
   */
  public function rebuildCache($opts = self::OPTS) {
    $this->init($opts['site']);
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
    $collection->add(
      $this->taskDrushUserLogin($uid)
    );
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

  /**
   * Return a path for dump database.
   *
   * @return string
   */
  public static function getPathDump() {
    $dir = Configurations::get('project.backups_dir', './');
    $environment = Environment::getEnvironment();
    $uri = Configurations::get('drupal.site.uri', 'default');
    $date = date('Ymd_His');
    $dump_name = "{$uri}.{$environment}.{$date}.sql";
    return $dir . DIRECTORY_SEPARATOR . $dump_name;
  }

}
