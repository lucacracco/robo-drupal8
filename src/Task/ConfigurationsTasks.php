<?php

namespace Lucacracco\Drupal8\Robo\Task;

/**
 * Class ConfigurationsTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task
 */
class ConfigurationsTasks extends BaseTasks {

  /**
   * Configuration Export.
   *
   * Clear cache and export into destination or default configuration directory.
   *
   * @param string|NULL $destination
   *
   * @return $this
   */
  public function configurationExport($destination = NULL) {
    $task_list = [
      'cacheRebuild' => $this->drushStack()->drush('cache-rebuild'),
      'export' => $this->drushStack()
        ->drush('config-export' . (!empty($destination) ? "--destination=" . $destination : '')),
    ];
    $this->collection->addTaskList($task_list);

    return $this;
  }

  /**
   * Configuration Import.
   *
   * Clear cache before and after import.
   *
   * @return $this
   */
  public function configurationImport() {
    $task_list = [
      'cacheRebuildBeforeImport' => $this->drushStack()->drush('cache-rebuild'),
      'export' => $this->drushStack()
        ->drush('config-import'),
      'cacheRebuildAfterImport' => $this->drushStack()->drush('cache-rebuild'),
    ];
    $this->collection->addTaskList($task_list);

    return $this;
  }

}
