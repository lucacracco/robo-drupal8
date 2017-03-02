<?php

namespace Lucacracco\Drupal8\Robo;

use Lucacracco\Drupal8\Robo\Utility\Configurations;
use Robo\Exception\TaskException;
use Robo\Result;
use Lucacracco\Drupal8\Robo\Utility\Drupal;
use Lucacracco\Drupal8\Robo\Utility\PathResolver;

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
  use \Lucacracco\Drupal8\Robo\Task\FileSystem\loadTasks;
  use \Lucacracco\Drupal8\Robo\Task\Site\loadTasks;

  /**
   * Constructor.
   */
  public function __construct() {

    // Initialize path base.
    PathResolver::init('.');

    // Configurations override.
    $configuration_overrides = [
      'site_configuration.name' => 'Pippo',
    ];

    // Initialize configurations for Drupal8 project.
    Configurations::init(
      [
        PathResolver::root() . '/build/local.default.yml.dist',
//        '?'. PathResolver::root() . '/build/local.default.yml',
      ],
      $configuration_overrides
    );
  }

  public function testFunction() {
    $collection = $this->collectionBuilder();

//    $collection->addTask($this->taskDatabaseDumpExport(PathResolver::getBasePath().'/pippo.sql'));
//    $collection->addTask($this->taskDatabaseDumpImport(PathResolver::getBasePath().'/pippo.sql'));

//    $collection->addTask($this->taskSiteInstall()->buildNew());
//    $collection->addTask($this->taskDrushCacheRebuild());

//    $modules_dev = Configurations::get('modules_dev');
//    $collection->addTask($this->taskDrushCacheRebuild());
//    $collection->addTask($this->taskDrushUninstallExtension($modules_dev));
//    $collection->addTask($this->taskDrushCacheRebuild());
//    $collection->addTask($this->taskDrushEnableExtension($modules_dev));
    return $collection->run();

  }


  /**
   * Build a new site.
   *
   * @return \Robo\Result
   *   The command result.
   */
  public function buildNew() {
    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskSiteInstall()->buildNew());
    return $collection->run();
  }

  /**
   * Build a site from configurations dir.
   *
   * @return \Robo\Result
   *   The command result.
   */
  public function buildConf() {
    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskSiteInstall()->buildConf());
    return $collection->run();
  }

  /**
   * Build a site from configuration files using profile 'config_installer'.
   *
   * @return \Robo\Result
   *   The command result.
   */
  public function buildConfProfile() {
    $collection = $this->collectionBuilder();

    return $collection->run();
  }

  /**
   * Build an existing site by importing the database.
   *
   * @param array $opts Options.
   *   Options.
   * @option $dbname|d Database name
   *
   * @return Result
   *   The command result.
   */
  public function buildFromDatabase($opts = ['dbname|d' => NULL]) {
    $collection = $this->collectionBuilder();

    return $collection->run();
  }

  /**
   * Export configuration.
   *
   * @return Result
   *   The command result.
   */
  public function configurationExport() {
    $collection = $this->collectionBuilder();
    $modules_dev = Configurations::get('modules_dev');
    $collection->addTask($this->taskDrushUninstallExtension($modules_dev));
    $collection->addTask($this->taskDrushCacheRebuild());
    $collection->addTask($this->taskDrushConfigExport());
    $collection->addTask($this->taskDrushEnableExtension($modules_dev));
    return $collection->run();
  }

  /**
   * Import configuration.
   *
   * @return Result
   *   The command result.
   */
  public function configurationImport() {
    $collection = $this->collectionBuilder();
    $modules_dev = Configurations::get('modules_dev');
    $collection->addTask($this->taskDrushUninstallExtension($modules_dev));
    $collection->addTask($this->taskDrushCacheRebuild());
    $collection->addTask($this->taskDrushConfigImport());
    $collection->addTask($this->taskDrushEnableExtension($modules_dev));
    return $collection->run();
  }

  /**
   * Rebuild Cache.
   *
   * @return Result
   *   The command result.
   */
  public function siteRebuildCache() {

    $collection = $this->collectionBuilder();

    // Rebuild cache.
    $collection->addTask($this->taskDrushCacheRebuild());

    return $collection->run();
  }

  /**
   * Update Translations of drupal.
   *
   * @return Result
   *   The command result.
   */
  public function updateTranslations() {
    $collection = $this->collectionBuilder();

    return $collection->run();
  }

  /**
   * Update database pending of drupal.
   *
   * @return Result
   *   The command result.
   */
  public function updateDatabase() {
    $collection = $this->collectionBuilder();

    return $collection->run();
  }

  /**
   * Index items for all enabled search indexes.
   *
   * @return Result
   *   The command result.
   *
   * @throws \Robo\Exception\TaskException
   */
  public function searchapiIndex() {
    throw new TaskException($this, 'Not yet implemented');
  }

  /**
   * Clear all search indexes and mark them for reindexing.
   *
   * @return Result
   *   The command result.
   *
   * @throws \Robo\Exception\TaskException
   */
  public function searchapiClear() {
    throw new TaskException($this, 'Not yet implemented');
  }

  /**
   * Database export.
   *
   * @param string $file_path
   *   File path to save dump.
   *
   * @return \Robo\Result
   *   The command result.
   *
   * @throws \Robo\Exception\TaskException
   *   If drupal site isn't bootstrapped.
   */
  public function databaseExport($file_path) {

    // Check installation bootstrapped.
    if(!$this->statusIsBootstrapped($this->getSiteStatus())){
      throw new TaskException($this, 'Site not installed.');
    }

    // TODO: check permission file

    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskDatabaseDumpExport($file_path));
    return $collection->run();
  }

  /**
   * Database import.
   *
   * @param string $file_path
   *   File .sql to load.
   *
   * @return \Robo\Result
   *   The command result.
   *
   * @throws \Robo\Exception\TaskException
   *   If file not exist or drupal.
   */
  public function databaseImport($file_path) {

    // Check installation bootstrapped.
    if(!$this->statusIsBootstrapped($this->getSiteStatus())){
      throw new TaskException($this, 'Site not installed.');
    }

    // TODO: check extension and if exist.
    if(!PathResolver::existDir($file_path)){
      throw new TaskException($this, "Not found file dump to load");
    }

    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskDatabaseDumpImport($file_path));
    return $collection->run();
  }

  /**
   * Update project database dump.
   *
   * This command refreshes the 'project.sql' database dump file with all latest
   * changes (e.g. config updates).
   *
   * @param string $environment An environment string.
   *
   * @return Result|null
   *   The command result.
   */
  public function dumpUpdate($environment) {
    // Show notice fro dropped database tables.
    $this->yell('!!! All database tables will be dropped - This action cannot be undone !!!', 40, 'red');

    // Ask for confirmation.
    $continue = $this->confirm('Are you sure you want to continue');

    if ($continue) {
      $collection = $this->dumpUpdateCollection($environment);
      return $collection->run();
    }

    return NULL;
  }

  /**
   * Install site.
   *
   * If a 'project.sql' database dump file is availble, the site will be
   * installed using that dump file and all exported configuration (if any).
   *
   * If there is no 'project.sql' file available, the site is installed from
   * scratch, the database dump file and all configuration is exported
   * afterwards.
   *
   * @param string $environment An environment string.
   *
   * @return Result|null
   *   The command result.
   */
  public function siteInstall($environment = 'local') {

//    $this->taskEnvironmentInitialize($environment)->run();

//    $this->taskSiteStatus($environment)->run();
//    Drupal::isInstalled();

    // Already installed -> Abort.
//    if (Drupal::isInstalled()) {
    $continue = TRUE;
    if ($this->collectionBuilder()->taskSiteStatus($environment)->run()) {
      $this->yell('!!! All data will be lost - This action cannot be undone !!!', 40, 'red');

      // Ask for confirmation.
      $continue = $this->confirm('Are you sure you want to continue');

    }

    // Not installed -> run tasks.
    $collection = $this->siteInstallCollection($environment);

    return $collection->run();
  }

  /**
   * Update site.
   *
   * Runs all update tasks on the site.
   *
   * @param string $environment An environment string.
   * @param array $opts
   *
   * @option $maintenance-mode Take site offline during site update.
   *
   * @return Result|null
   *   The command result.
   */
  public function siteUpdate($environment, $opts = ['maintenance-mode' => FALSE]) {
    $this->taskEnvironmentInitialize($environment)->run();
    // Not installed -> Abort.
    if (!Drupal::isInstalled()) {
      $this->yell('Site is not installed', 40, 'red');
      $this->say('Run <fg=yellow>site:install</fg=yellow> command instead.');
    }

    // Installed -> run tasks.
    else {
      $collection = $this->collection();

      // Take site offline (if --maintenance-mode option is set).
      if ($opts['maintenance-mode']) {
        $collection->add([
          'Update.enableMaintenanceMode' => $this->taskSiteMaintenanceMode(TRUE)
        ]);
      }

      // Perform update tasks.
      $collection->add($this->siteUpdateCollection($environment));

      // Bring site back online (if --maintenance-mode option is set).
      if ($opts['maintenance-mode']) {
        $collection->add([
          'Update.disableMaintenanceMode' => $this->taskSiteMaintenanceMode(FALSE)
        ]);
      }

      return $collection->run();
    }

    return NULL;
  }

  /**
   * Return task collection for 'dump:update' command.
   *
   * @param string $environment
   *   An environment string.
   *
   * @return \Robo\Collection\Collection
   *   The task collection.
   */
  protected function dumpUpdateCollection($environment) {
    $dump = PathResolver::databaseDump();
    $collection = $this->collection();

    // Initialize site.
    $collection->add($this->taskSiteInitialize($environment)->collection());

    $collection->add([
      // Drop all database tables.
      'Base.sqlDrop' => $this->taskDrushSqlDrop(),
      // Import database.
      'Base.databaseDumpImport' => $this->taskDatabaseDumpImport($dump),
    ]);

    // Perform update tasks.
    $collection->add($this->taskSiteUpdate($environment)->collection());

    $collection->add([
      // Export database.
      'Base.databaseDumpExport' => $this->taskDatabaseDumpExport($dump),
    ]);

    return $collection;
  }

  /**
   * Return task collection for 'site:install' command.
   *
   * @param string $environment
   *   An environment string.
   *
   * @return \Robo\Collection\Collection
   *   The task collection.
   */
  protected function siteInstallCollection($environment) {
    $collection = $this->collection();

    // Initialize site.
    $collection->add($this->taskSiteInitialize($environment)->collection());

    // Install site.
    $collection->add($this->taskSiteInstall($environment)->collection());

    return $collection;
  }

  /**
   * Return task collection for 'site:update' command.
   *
   * @param string $environment
   *   An environment string.
   *
   * @return \Robo\Collection\Collection
   *   The task collection.
   */
  protected function siteUpdateCollection($environment) {
    $collection = $this->collection();

    // Perform basic setup.
    $collection->add($this->taskSiteInitialize($environment)->collection());

    // Update site.
    $collection->add($this->taskSiteUpdate($environment)->collection());

    return $collection;
  }

}
