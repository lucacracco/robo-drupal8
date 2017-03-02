<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

use Lucacracco\Drupal8\Robo\Utility\PathResolver;
use Robo\Result;

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
//      'SiteSettings.configure' => $this->collectionBuilder()
//        ->taskSiteSettings()
//        ->updateSettings(),
      // Ensure 'config' and 'locale' module.
//      'Install.enableExtensions' => $this->collectionBuilder()
//        ->taskDrushEnableExtension(['config', 'locale']),
//      // Update translations.
//      'Install.localeUpdate' => $this->collectionBuilder()
//        ->taskDrushLocaleUpdate(),
      // Rebuild caches.
      'Install.cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild(),
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

  public function buildConf() {

    $task_list = [
      // Composer install for first time.
      'SiteInitialize.composer' => $this->collectionBuilder()
        ->taskSiteInitialize()
        ->composer(),
      // Setup filesystem.
      'SiteSetupFileSystem.clear_init' => $this->collectionBuilder()
        ->taskSiteSetupFileSystem()
        ->clear()
        ->init(),
      // Install site.
      'DrushSiteInstall.buildNewSite' => $this->collectionBuilder()
        ->taskDrushSiteInstall()
        ->buildNewSite(),
      'SiteSettings.updateSettings' => $this->collectionBuilder()
        ->taskSiteSettings()
        ->updateSettings(),
      'DrushConfigImport' => $this->collectionBuilder()
        ->taskDrushConfigImport(),
      // Ensure 'config' and 'locale' module.
      'DrushEnableExtension' => $this->collectionBuilder()
        ->taskDrushEnableExtension(['config', 'locale']),
      // Update translations.
      'DrushLocaleUpdate' => $this->collectionBuilder()
        ->taskDrushLocaleUpdate(),
      // Rebuild caches.
      'DrushCacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild(),
    ];

    // Initialize site.
    $this->collection->addTaskList($task_list);

    return $this;
  }


//  /**
//   * Return task collection for this task.
//   *
//   * @return \Robo\Collection\Collection
//   *   The task collection.
//   */
//  public function collection() {
//    $collection = new Collection();
//    $dump = PathResolver::databaseDump();
//
//    // No database dump file present -> perform initial installation, export
//    // configuration and create database dump file.
//    if (!file_exists($dump)) {
//      $collection->add([
//        // Install Drupal site.
//        'Install.siteInstall' => new SiteInstall(),
//      ]);
//
//      // Set up file system.
//      $collection->add((new SetupFileSystem($this->environment))->collection());
//
//      $collection->add([
//        // Ensure 'config' and 'locale' module.
//        'Install.enableExtensions' => new EnableExtension(['config', 'locale']),
//        // Update translations.
//        'Install.localeUpdate' => new LocaleUpdate(),
//        // Rebuild caches.
//        'Install.cacheRebuild' => new CacheRebuild(),
//        // Export configuration.
//        'Install.configExport' => new ConfigExport(),
//        // Export database dump file.
//        'Install.databaseDumpExport' => new Export($dump),
//      ]);
//    }
//
//    // Database dump file already exists -> import it and update database with
//    // latest exported configuration (if any).
//    else {
//      $collection->add([
//        // Drop all tables.
//        'Install.sqlDrop' => new SqlDrop(),
//        // Import database dump.
//        'Install.databaseDumpImport' => new Import($dump)
//      ]);
//
//      // Perform site update tasks
//      $collection->add((new Update($this->environment))->collection());
//    }
//
//    return $collection;
//  }

}
