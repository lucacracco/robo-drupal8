<?php

namespace Lucacracco\Drupal8\Robo\Task;

use Lucacracco\Drupal8\Robo\Utility\Environment;

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
   * Reinstall modules if environment isn't production.
   *
   * @param string|NULL $destination
   * @param string[] $skip_modules
   *
   * @return $this
   */
  public function configurationExport($destination = NULL, $skip_modules = []) {

    $skip_modules_dev = $this->config->get('drupal.site.modules_dev', []);
    $skip_modules = array_merge($skip_modules_dev, $skip_modules);

    $task_list = [
      'uninstallModules' => $this->drushStack()
        ->argsForNextCommand($skip_modules)
        ->drush("pm-uninstall"),
      'cacheRebuild' => $this->drushStack()->drush('cache-rebuild'),
      'export' => $this->drushStack()
        ->drush('config-export' . (!empty($destination) ? "--destination=" . $destination : '')),
    ];
    $this->collection->addTaskList($task_list);

    if (!Environment::isProduction()) {
      $this->collection->add(
        $this->drushStack()
          ->argsForNextCommand($skip_modules)
          ->drush("pm-enable"), 'enableModules'
      );
    }

    return $this;
  }

  /**
   * Configuration Import.
   *
   * Clear cache before and after import.
   * Skip modules variable for add module to not export configuration.
   * Default not export development modules configuration.
   * Reinstall modules if environment isn't production.
   *
   * @param string[] $skip_modules
   *
   * @return $this
   */
  public function configurationImport($skip_modules = []) {

    $skip_modules_dev = $this->config->get('drupal.site.modules_dev', []);
    $skip_modules = array_merge($skip_modules_dev, $skip_modules);

    $task_list = [
      'uninstallModules' => $this->drushStack()
        ->argsForNextCommand($skip_modules)
        ->drush("pm-uninstall"),
      'cacheRebuildBeforeImport' => $this->drushStack()->drush('cache-rebuild'),
      'export' => $this->drushStack()
        ->drush('config-import'),
      'cacheRebuildAfterImport' => $this->drushStack()->drush('cache-rebuild'),
    ];
    $this->collection->addTaskList($task_list);

    if (!Environment::isProduction()) {
      $this->collection->add(
        $this->drushStack()
          ->argsForNextCommand($skip_modules)
          ->drush("pm-enable"), 'enableModules'
      );
    }

    return $this;
  }

}