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
   * Skip modules variable for add module to not export configuration.
   * Default not export development modules configuration.
   *
   * @param string|NULL $destination
   * @param array $skip_modules
   *
   * @return $this
   */
  public function configurationExport($destination = NULL, $skip_modules = []) {

    $skip_modules_dev = $this->config->get('drupal.site.modules_dev', []);
    $skip_modules = array_merge($skip_modules_dev, $skip_modules);

    $task_list = [
      'cacheRebuild' => $this->drushStack()->drush('cache-rebuild'),
      'export' => $this->drushStack()
        ->argForNextCommand("--skip-modules=" . implode(', ', $skip_modules))
        ->drush('config-export' . isset($destination) ? "--destination=" . $destination : ''),
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

  /**
   * Configuration Import.
   *
   * Clear cache before and after import.
   *
   * @param array $skip_modules
   *
   * @return $this
   */
  public function configurationImport($skip_modules = []) {
    $skip_modules_dev = $this->config->get('drupal.site.modules_dev', []);
    $skip_modules = array_merge($skip_modules_dev, $skip_modules);

    $task_list = [
      'cacheRebuildBeforeImport' => $this->drushStack()->drush('cache-rebuild'),
      'export' => $this->drushStack()
        ->argForNextCommand("--skip-modules=" . implode(', ', $skip_modules))
        ->drush('config-export'),
      'cacheRebuildAfterImport' => $this->drushStack()->drush('cache-rebuild'),
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

}