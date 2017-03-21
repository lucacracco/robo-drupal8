<?php

namespace Lucacracco\Drupal8\Robo;

use Robo\Exception\TaskException;
use Robo\Result;

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
  use CollectionTasks;

  /**
   * Build a new site.
   *
   * @return \Robo\Result
   *   The command result.
   */
  public function buildNew() {
    $collection = $this->collectionBuildNew();
    $collection->addTask($this->taskDrushUserLogin());
    return $collection->run();
  }

  /**
   * Build a site from configurations dir.
   *
   * @return \Robo\Result
   *   The command result.
   */
  public function buildConf() {
    $collection = $this->collectionBuildConf();
    $collection->addTask($this->taskDrushUserLogin());
    return $collection->run();
  }

  /**
   * Build a site from configuration files using profile 'config_installer'.
   *
   * @return \Robo\Result
   *   The command result.
   */
  public function buildConfProfile() {
    $collection = $this->collectionBuildConfProfile();
    $collection->addTask($this->taskDrushUserLogin());
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
    $collection = $this->collectionBuildFromDatabase($opts['dbname']);
    $collection->addTask($this->taskDrushUserLogin());
    return $collection->run();
  }

  /**
   * Export configuration.
   *
   * @return Result
   *   The command result.
   */
  public function configurationExport() {
    $collection = $this->collectionConfigurationExport();
    return $collection->run();
  }

  /**
   * Import configuration.
   *
   * @return Result
   *   The command result.
   */
  public function configurationImport() {
    $collection = $this->collectionConfigurationImport();
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
    $collection->addTask($this->taskDrushCacheRebuild());
    return $collection->run();
  }

  /**
   * Set site in maintenance.
   *
   * @param bool $mode
   *   Value of maintenance.
   *
   * @return \Robo\Result
   */
  public function siteMaintenanceMode($mode = TRUE) {
    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskSiteMaintenanceMode($mode));
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
    $collection->addTask($this->taskDrushLocaleUpdate());
    $collection->addTask($this->taskDrushCacheRebuild());
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
    $collection->addTask($this->taskDrushApplyDatabaseUpdates());
    $collection->addTask($this->taskDrushCacheRebuild());
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
    $collection = $this->collectionDatabaseExport($file_path);
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
    $collection = $this->collectionDatabaseImport($file_path);
    return $collection->run();
  }

  /**
   * User login.
   *
   * @param int $uid
   *   Drupal user id.
   *
   * @return \Robo\Result
   */
  public function siteUserLogin($uid = 1) {
    $collection = $this->collectionBuilder();
    $collection->addTask(
      $this->taskDrushUserLogin($uid)
    );
    return $collection->run();
  }

}
