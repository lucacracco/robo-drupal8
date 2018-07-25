<?php

namespace Lucacracco\RoboDrupal8\Robo\Wizards;

/**
 * Class SetupWizard.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Wizards
 */
class SetupWizard extends Wizard {

  /**
   * Wizard for generating directory sync.
   *
   * @throws \Exception
   */
  public function wizardGenerateConfigurationDirectorySync() {
    $missing = FALSE;
    if (!$this->getInspector()->isConfigurationDirectorySyncPresent()) {
      $this->logger->warning("<comment>{$this->getConfigValue('drupal.config_directories.sync')}</comment> is missing.");
      $missing = TRUE;
    }
    if ($missing) {
      $confirm = $this->confirm("Do you want to generate this required directory?");
      if ($confirm) {
        $this->fs
          ->mkdir($this->getConfigValue('drupal.config_directories.sync'));
      }
      else {
        throw new \Exception("<comment>{$this->getConfigValue('drupal.config_directories.sync')}</comment> is required.");
      }
    }
  }

  /**
   * Wizard for insert mysql connection.
   *
   * @throws \Exception
   */
  public function wizardMySqlConnection() {
    $required_config = ['database', 'host', 'port', 'user', 'pass',];

    $update_config = FALSE;
    foreach ($required_config as $required) {

      $config_v = $this->getConfigValue("drupal.database.$required");
      if (!empty($config_v)) {
        continue;
      }

      $update_config = TRUE;
      $config_input = $this->ask("Please insert \"$required\" of database connection.");
      if (empty($config_input)) {
        throw new \InvalidArgumentException("Impossible continue without \"$required\" of database");
      }
      $this->setConfigValue("drupal.database.$required", $config_input);
    }

    return $update_config;
  }

}
