<?php

namespace Lucacracco\Drupal8\Robo;

use Lucacracco\Drupal8\Robo\Utility\PathResolver;
use Robo\Exception\TaskException;

/**
 * Class CollectionTasks.
 *
 * Provides a collection of task for each functionality.
 *
 * @package Lucacracco\Drupal8\Robo
 */
trait CollectionTasks {

  /**
   * Build a new site.
   *
   * @return \Robo\Collection\CollectionBuilder
   */
  protected function collectionBuildNew() {
    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskSiteInstall()->buildNew());
    return $collection;
  }

  /**
   * Build a site from configurations dir.
   *
   * @return \Robo\Collection\CollectionBuilder
   */
  protected function collectionBuildConf() {
    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskSiteInstall()->buildConf());
    return $collection;
  }

  /**
   * Build a site from configuration files using profile 'config_installer'.
   *
   * @return \Robo\Collection\CollectionBuilder
   */
  protected function collectionBuildConfProfile() {
    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskSiteInstall()->buildConfProfile());
    return $collection;
  }

  /**
   * Build an existing site by importing the database.
   *
   * @param string $dbname
   *   Database name
   *
   * @return \Robo\Collection\CollectionBuilder
   */
  protected function collectionBuildFromDatabase($dbname = NULL) {
    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskSiteInstall()
      ->buildFromDatabase($dbname));
    return $collection;
  }

  /**
   * Export configuration.
   *
   * @return \Robo\Collection\CollectionBuilder
   */
  protected function collectionConfigurationExport($modules_dev = []) {
    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskDrushUninstallExtension($modules_dev));
    $collection->addTask($this->taskDrushCacheRebuild());
    $collection->addTask($this->taskDrushConfigExport());
    $collection->addTask($this->taskDrushEnableExtension($modules_dev));
    return $collection;
  }

  /**
   * Import configuration.
   *
   * @return \Robo\Collection\CollectionBuilder
   */
  protected function collectionConfigurationImport($modules_dev = []) {
    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskDrushUninstallExtension($modules_dev));
    $collection->addTask($this->taskDrushCacheRebuild());
    $collection->addTask($this->taskDrushConfigImport());
    $collection->addTask($this->taskDrushEnableExtension($modules_dev));
    return $collection;
  }

  /**
   * TODO: Index items for all enabled search indexes.
   *
   * @return \Robo\Collection\CollectionBuilder
   *
   * @throws \Robo\Exception\TaskException
   */
  protected function collectionSearchapiIndex() {
    $collection = $this->collectionBuilder();
    return $collection;
  }

  /**
   * TODO: Clear all search indexes and mark them for reindexing.
   *
   * @return \Robo\Collection\CollectionBuilder
   *
   * @throws \Robo\Exception\TaskException
   */
  protected function collectionSearchapiClear() {
    $collection = $this->collectionBuilder();
    return $collection;
  }

  /**
   * Database export.
   *
   * @param string $file_path
   *   File path to save dump.
   *
   * @return \Robo\Collection\CollectionBuilder
   *
   * @throws \Robo\Exception\TaskException
   *   If drupal site isn't bootstrapped.
   */
  protected function collectionDatabaseExport($file_path) {

    // Check installation bootstrapped.
    if (!$this->statusIsBootstrapped($this->getSiteStatus())) {
      throw new TaskException($this, 'Site not installed.');
    }

    // TODO: check permission file

    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskDrushCacheRebuild());
    $collection->addTask($this->taskDatabaseDumpExport($file_path));
    return $collection;
  }

  /**
   * Database import.
   *
   * @param string $file_path
   *   File .sql to load.
   *
   * @return \Robo\Collection\CollectionBuilder
   *
   * @throws \Robo\Exception\TaskException
   *   If file not exist or drupal.
   */
  protected function collectionDatabaseImport($file_path) {

    // Check installation bootstrapped.
    if (!$this->statusIsBootstrapped($this->getSiteStatus())) {
      throw new TaskException($this, 'Site not installed.');
    }

    // TODO: check extension and if exist.
    if (!PathResolver::existDir($file_path)) {
      throw new TaskException($this, "Not found file dump to load");
    }

    $collection = $this->collectionBuilder();
    $collection->addTask($this->taskDatabaseDumpImport($file_path));
    $collection->addTask($this->taskDrushCacheRebuild());
    return $collection;
  }

}
