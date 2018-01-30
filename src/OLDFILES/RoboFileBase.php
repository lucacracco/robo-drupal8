<?php

namespace Lucacracco\Drupal8\Robo;

use Lucacracco\Drupal8\Robo\Utility\Environment;
use Lucacracco\Drupal8\Robo\Utility\PathResolver;
use Robo\Collection\Collection;
use Robo\Exception\TaskException;

/**
 * Console commands configuration base for Robo task runner.
 *
 *
 * @see http://robo.li/
 */
class RoboFileBase extends \Robo\Tasks {

  use \Robo\Task\Filesystem\loadShortcuts;
  use \Lucacracco\Drupal8\Robo\Common\Drupal;
  use \Lucacracco\Drupal8\Robo\Stack\loadTasks;
  use \Lucacracco\Drupal8\Robo\Task\loadTasks;

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
      $collection->add($this->databaseExportTask());
    }
    $collection->add($this->taskDrupalInstallTasks()->buildConf());
    $collection->add($this->taskDrupalMaintenanceTasks()->loginOneTimeUrl());
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
      $collection->add($this->databaseExportTask());
    }
    $config_subdir = \Robo\Robo::config()->get('drupal.site.config_dir', NULL);
    if (!isset($config_subdir)) {
      throw new \InvalidArgumentException("Configuration dir not found.");
    }

    $collection->add($this->taskDrupalInstallTasks()
      ->buildConfigInstaller(
        [
          "config_installer_sync_configure_form.sync_directory=\"{$config_subdir}\"",
        ]
      )
    );

    // Create a url for login.
    $collection->add($this->taskDrupalMaintenanceTasks()
      ->loginOneTimeUrl(1), 'UserLogin');

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
      $collection->add($this->databaseExportTask());
    }

    // Build site.
    $collection->add($this->taskDrupalInstallTasks()
      ->buildFromDatabase($opts['dbname']));

    // Create a url for login.
    $collection->add($this->taskDrupalMaintenanceTasks()
      ->loginOneTimeUrl(1), 'UserLogin');

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
      $collection->add($this->databaseExportTask());
    }

    if (Environment::needsBuild()) {
      // TODO: check and remove comment.
      //      // Composer install for first time.
      //      $collection->add(
      //        $this->taskSiteInitialize(PathResolver::root(), Environment::needsBuild())
      //          ->composerInstall(),
      //        'composerInstall'
      //      );
    }

    // Install site.
    $collection->add(
      $this->taskDrupalInstallTasks()
        ->buildNew(), 'taskDrupalInstallTasks.buildNew'
    );

    // Create a url for login.
    $collection->add($this->taskDrupalMaintenanceTasks()
      ->loginOneTimeUrl(1), 'UserLogin');

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
    $collection->add($this->databaseExportTask($file_path));
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
    // TODO: autoload last dump.
    $collection->add($this->drushStack()->drush('sql-drop'));
    $collection->add($this->drushStack()
      ->argForNextCommand('< ' . escapeshellarg($file_path))
      ->drush('sql-cli'));
    return $collection;
  }

  /**
   * Exec drush command.
   *
   * @param string $arg
   *   Command to exec.
   *
   * @return \Robo\Collection\Collection
   */
  public function drush($arg = "") {
    $collection = new Collection();
    $collection->add(
      $this->drushStack()
        ->drush($arg), 'drush'
    );
    return $collection;
  }

}
