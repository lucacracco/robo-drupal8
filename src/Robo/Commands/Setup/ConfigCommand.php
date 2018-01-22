<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "setup:config*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Setup
 */
class ConfigCommand extends RoboDrupal8Tasks {

  /**
   * Update current database to reflect the state of the Drupal file system.
   *
   * @command setup:config:update
   * @aliases su
   */
  public function update() {
    $this->invokeCommands(['setup:config-import']);
  }

  /**
   * Checks whether core config is overridden.
   *
   * @param string $cm_core_key
   *
   * @throws \Exception
   */
  protected function checkConfigOverrides($cm_core_key) {
    // Check for configuration overrides.
    if (!$this->getConfigValue('cm.allow-overrides')) {
      $this->say("Checking for config overrides...");
      $config_overrides = $this->taskDrush()
        ->drush("cex")
        ->arg($cm_core_key);
      if (!$config_overrides->run()->wasSuccessful()) {
        throw new \Exception("Configuration in the database does not match configuration on disk. RD8 has attempted to automatically fix this by re-exporting configuration to disk. Please read https://github.com/acquia/blt/wiki/Configuration-overrides");
      }
    }
  }

  /**
   * Imports configuration from the config directory.
   *
   * @command setup:config-import
   * @aliases sci
   *
   * @validateDrushConfig
   */
  public function import() {
    $cm_core_key = $this->getConfigValue('cm.core.key');
    $this->logConfig($this->getConfigValue('cm'), 'cm');

    // First check to see if required config is exported.
    $core_config_file = $this->getConfigValue('docroot') . '/' . $this->getConfigValue("cm.core.dirs.$cm_core_key.path") . '/core.extension.yml';

    if (!file_exists($core_config_file)) {
      $this->logger->warning("RD8 will NOT import configuration, $core_config_file was not found.");
      // This is not considered a failure.
      return 0;
    }

    $task = $this->taskDrush()
      ->stopOnFail()
      // Sometimes drush forgets where to find its aliases.
      ->drush("cc")->arg('drush')
      // Rebuild caches in case service definitions have changed.
      // @see https://www.drupal.org/node/2826466
      ->drush("cache-rebuild")
      // Execute db updates.
      // This must happen before features are imported or configuration is
      // imported. For instance, if you add a dependency on a new extension to
      // an existing configuration file, you must enable that extension via an
      // update hook before attempting to import the configuration.
      // If a db update relies on updated configuration, you should import the
      // necessary configuration file(s) as part of the db update.
      ->drush("updb");

    // Use 'config-split'.
    $this->importConfigSplit($task, $cm_core_key);


    $task->drush("cache-rebuild");
    $result = $task->run();
    if (!$result->wasSuccessful()) {
      throw new \Exception("Failed to import configuration!");
    }

    if ($this->getConfigValue('cm.features.no-overrides')) {
      $this->logger->warning("Features override checks are currently disabled due to a Drush 9 incompatibility.");
      // @codingStandardsIgnoreLine
      // $this->checkFeaturesOverrides();
    }

    $this->checkConfigOverrides($cm_core_key);

    return $result;
  }

  /**
   * Import configuration using config_split module.
   *
   * @param \Lucacracco\RoboDrupal8\Robo\Tasks\DrushTask $task
   * @param string $cm_core_key
   */
  protected function importConfigSplit($task, $cm_core_key) {
    $task->drush("pm-enable")->arg('config_split');
    $task->drush("config-import")->arg($cm_core_key);
  }


}