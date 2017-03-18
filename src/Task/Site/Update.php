<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

/**
 * Robo task base: Update site.
 */
class Update extends SiteTask {

  /**
   * Return tasks with collection for clear cache, import config, update database pendings, schema and translations.
   *
   * @return $this
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

    return $this;
  }

  /**
   * Return tasks with collection for clear cache, import config, update database pendings and schema.
   *
   * @return $this
   */
  public function updateConfig() {
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
    ];

    $this->collection->addTaskList($task_list);

    return $this;
  }

}
