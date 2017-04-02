<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

use Lucacracco\Drupal8\Robo\Utility\Configurations;
use Lucacracco\Drupal8\Robo\Utility\PathResolver;
use Psy\Configuration;

/**
 * Robo task base: Install site.
 */
class Install extends SiteTask {

  /**
   * Constructor.
   */
  public function __construct() {
    parent::__construct();

    // Is valid environment?
    if (!$this->configurationValid()) {
      throw new \InvalidArgumentException(get_class($this) . ' - Configurations not valid');
    }
  }

  /**
   * Build new.
   *
   * @return $this
   */
  public function buildNew() {
    $task_list = [
      // Composer install for first time.
      'SiteInitialize.composerInstall' => $this->collectionBuilder()
        ->taskSiteInitialize()
        ->composerInstall(PathResolver::root()),
      // Setup filesystem.
      'SiteSetupFileSystem.clear_init' => $this->collectionBuilder()
        ->taskSiteSetupFileSystem()
        ->clear()
        ->init(),
      // Install site.
      'DrushInstall.buildNew' => $this->collectionBuilder()
        ->taskDrushInstall()
        ->buildNew(),
      'SiteSettings.configure' => $this->collectionBuilder()
        ->taskSiteSettings()
        ->updateSettings(),
      'DrushSystemSiteUuid' => $this->collectionBuilder()
        ->taskDrushSystemSiteUuid(Configurations::get('drupal.site.uuid')),
      // Rebuild caches.
      'Install.cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild(),
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

  /**
   * Build site from configurations folder.
   *
   * @param string $profile
   *   Name of profile to use.
   * @param array $profile_settings
   *   Configurations inline to command.
   *
   * @return $this
   */
  public function buildConf($profile = "minimal", $profile_settings = []) {

    $task_list = [
      // Composer install for first time.
      'SiteInitialize.composerInstall' => $this->collectionBuilder()
        ->taskSiteInitialize()
        ->composerInstall(PathResolver::root()),
      // Setup filesystem.
      'SiteSetupFileSystem.clear_init' => $this->collectionBuilder()
        ->taskSiteSetupFileSystem()
        ->clear()
        ->init(),
      // Install site.
      'DrushInstall.buildNew' => $this->collectionBuilder()
        ->taskDrushInstall()
        ->buildProfile($profile, $profile_settings),
      'SiteSettings.configure' => $this->collectionBuilder()
        ->taskSiteSettings()
        ->updateSettings(),
      'DrushSystemSiteUuid' => $this->collectionBuilder()
        ->taskDrushSystemSiteUuid(Configurations::get('drupal.site.uuid')),
      'DrushConfigImport' => $this->collectionBuilder()
        ->taskDrushConfigImport(),
      // Rebuild caches.
      'Install.cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild(),
    ];

    // Initialize site.
    $this->collection->addTaskList($task_list);

    return $this;
  }

  /**
   * Build site from backup.
   *
   * @param string $path_dump
   *   Path of dump to import. TODO: no check if exist.
   *
   * @return $this
   */
  public function buildFromDatabase($path_dump) {
    $task_list = [
      // Composer install for first time.
      'SiteInitialize.composerInstall' => $this->collectionBuilder()
        ->taskSiteInitialize()
        ->composerInstall(PathResolver::root()),
      // Setup filesystem.
      'SiteSetupFileSystem.clear_init' => $this->collectionBuilder()
        ->taskSiteSetupFileSystem()
        ->clear()
        ->init(),
      // Install site.
      'DrushInstall.buildNew' => $this->collectionBuilder()
        ->taskDrushInstall()
        ->buildProfile('minimal'),
      'SiteSettings.configure' => $this->collectionBuilder()
        ->taskSiteSettings()
        ->updateSettings(),
      'DatabaseDump.import' => $this->collectionBuilder()
        ->taskDatabaseDumpImport($path_dump),
      'DrushSystemSiteUuid' => $this->collectionBuilder()
        ->taskDrushSystemSiteUuid(Configurations::get('drupal.site.uuid')),
      // Rebuild caches.
      'Install.cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild(),
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

}
