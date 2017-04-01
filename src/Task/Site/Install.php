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
        ->setNeedsBuild(TRUE)
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
      // Ensure 'config' and 'locale' module.
      'Install.enableExtensions' => $this->collectionBuilder()
        ->taskDrushEnableExtension(['config', 'locale']),
      // Update translations.
      'Install.localeUpdate' => $this->collectionBuilder()
        ->taskDrushLocaleUpdate(),
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
   * @return $this
   */
  public function buildConf($profile = "minimal") {

    $task_list = [
      // Composer install for first time.
      'SiteInitialize.composerInstall' => $this->collectionBuilder()
        ->taskSiteInitialize()
        ->setNeedsBuild(TRUE)
        ->composerInstall(PathResolver::root()),
      // Setup filesystem.
      'SiteSetupFileSystem.clear_init' => $this->collectionBuilder()
        ->taskSiteSetupFileSystem()
        ->clear()
        ->init(),
      // Install site.
      'DrushInstall.buildNew' => $this->collectionBuilder()
        ->taskDrushInstall()
        ->buildProfile($profile),
      'SiteSettings.configure' => $this->collectionBuilder()
        ->taskSiteSettings()
        ->updateSettings(),
      'DrushSystemSiteUuid' => $this->collectionBuilder()
        ->taskDrushSystemSiteUuid(Configurations::get('drupal.site.uuid')),
      'DrushConfigImport' => $this->collectionBuilder()
        ->taskDrushConfigImport(),
      // Ensure 'config' and 'locale' module.
      'Install.enableExtensions' => $this->collectionBuilder()
        ->taskDrushEnableExtension(['config', 'locale']),
      // Update translations.
      'Install.localeUpdate' => $this->collectionBuilder()
        ->taskDrushLocaleUpdate(),
      // Rebuild caches.
      'Install.cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild(),
    ];

    // Initialize site.
    $this->collection->addTaskList($task_list);

    return $this;
  }

}
