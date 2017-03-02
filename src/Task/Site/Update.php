<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

/**
 * Robo task base: Update site.
 */
class Update extends SiteTask {

  /**
   * Function to check configuration.
   *
   * TODO: implement controll.
   *
   * @return bool
   */
  protected function configurationValid() {
    return TRUE;
  }

  /**
   * Return tasks collection for clear cache, import config, update database pendings, schema and translations.
   *
   * @return \Robo\Collection\Collection
   *   The task collection.
   */
  public function updateAll() {

    $task_list = [
      // Clear all caches.
      'Update.cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild(),
      // Import configuration.
      'Update.drushConfigImport' => $this->collectionBuilder()
        ->taskDrushConfigImport(),
      // Apply database updates.
      'Update.applyDatabaseUpdates' => $this->collectionBuilder()
        ->taskDrushApplyDatabaseUpdates(),
      // Import configuration (again, to ensure no stale configuration updates).
      'Update.drushConfigImportAgain' => $this->collectionBuilder()
        ->taskDrushConfigImport(),
      // Apply entity schema updates.
      'Update.applyEntitySchemaUpdates' => $this->collectionBuilder()
        ->taskDrushEntitySchemaUpdates(),
      // Clear all caches (again).
      'Update.cacheRebuildAgain' => $this->collectionBuilder()
        ->taskDrushCacheRebuild(),
      // Update translations.
      'Install.localeUpdate' => $this->collectionBuilder()
        ->taskDrushLocaleUpdate(),
    ];

    $this->collection->addTaskList($task_list);

    return $this->collection;
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    return $this->collection()->run();
  }

}
