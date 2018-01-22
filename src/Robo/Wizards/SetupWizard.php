<?php

namespace Lucacracco\RoboDrupal8\Robo\Wizards;

/**
 * Class SetupWizard.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Wizards
 */
class SetupWizard extends Wizard {

  /**
   * Wizard for generating setup files.
   *
   * Executes rd8 setup:settings command.
   *
   * @throws \Exception
   */
  public function wizardGenerateSettingsFiles() {
    $missing = FALSE;
    if (!$this->getInspector()->isDrupalLocalSettingsFilePresent()) {
      $this->logger->warning("<comment>{$this->getConfigValue('drupal.local_settings_file')}</comment> is missing.");
      $missing = FALSE;
    }
    if (!$this->getInspector()->isHashSaltPresent()) {
      $this->logger->warning("<comment>salt.txt</comment> is missing and required.");
      $missing = TRUE;
    }
    if ($missing) {
      $confirm = $this->confirm("Do you want to generate this required settings file(s)?");
      if ($confirm) {
        $bin = $this->getConfigValue('composer.bin');
        $this->executor
          ->execute("$bin/rd8 setup:settings")->printOutput(TRUE)->run();
      }
      else {
        throw new \Exception("Settings.php or salt.txt is required.");
      }
    }
  }

  /**
   * Wizard for installing Drupal.
   *
   * Executes rd8 setup:build:install.
   */
  public function wizardInstallDrupal() {
    if (!$this->getInspector()->isMySqlAvailable()) {
      return FALSE;
    }
    if (!$this->getInspector()->isDrupalInstalled()) {
      $this->logger->warning('Drupal is not installed.');
      $confirm = $this->confirm("Do you want to install Drupal?");
      if ($confirm) {
        $bin = $this->getConfigValue('composer.bin');
        $this->executor
          ->execute("$bin/rd8 setup")
          ->detectInteractive()
          ->run();
        $this->getInspector()->clearState();
      }
    }
  }

}
