<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\Common\MySqlConnection;
use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "drupal:install-*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Commands
 */
class InstallCommand extends RoboDrupal8Tasks {

  /**
   * Install scratch Drupal.
   *
   * @command drupal:install-scratch
   * @hidden
   *
   * @interactDrupalIsAlreadyInstalled
   *
   * @validateMySqlAvailable
   * @validateDocrootIsPresent
   */
  public function drupalInstallScratch() {
    $this->install()->detectInteractive()->run();
    $this->getInspector()->clearState();
  }

  /**
   * Install from configuration.
   *
   * @command drupal:install-from-config
   * @hidden
   *
   * @interactDrupalIsAlreadyInstalled
   *
   * @validateDocrootIsPresent
   * @validateDrupalConfigurationDirectorySync
   */
  public function drupalInstallFromConfig() {
    $this->installWithConfig()->detectInteractive()->run();
    $this->getInspector()->clearState();
  }

  /**
   * Installs Drupal and imports configuration.
   *
   * @return \Lucacracco\RoboDrupal8\Robo\Tasks\Drush
   *
   * @throws \Exception
   */
  protected function installWithConfig() {
    $task = $this->install();
    $config_directories = $this->getConfigValue("drupal.site.directory.config");
    $task->option('config-dir', $config_directories);
    return $task;
  }

  /**
   * Get base install TaskCommand.
   *
   * @return \Lucacracco\RoboDrupal8\Robo\Tasks\Drush
   *
   * @throws \Exception
   */
  protected function install($profile = '') {

    $username = $this->getConfigValue('drupal.account.username', 'admin');
    $password = $this->getConfigValue('drupal.account.password', 'admin');
    $mail = $this->getConfigValue('drupal.account.mail', 'admin@localhost');
    $profile = empty($profile) ? $this->getConfigValue('drupal.site.profile', 'minimal') : $profile;
    $database_config = $this->getConfigValue('drupal.databases.default.default', NULL);

    if (empty($database_config)) {
      throw new \Exception("Database configuration is missing.");
    }

    $db_url = MySqlConnection::convertDatabaseFromDatabaseArray($database_config);

    /** @var \Lucacracco\RoboDrupal8\Robo\Tasks\Drush $task */
    $task = $this->taskDrush()
      ->drush("site-install")
      ->arg($profile)
      //->rawArg("install_configure_form.update_status_module='array(FALSE,FALSE)'")
      //->rawArg("install_configure_form.enable_update_status_module=NULL")
      ->option('site-name', $this->getConfigValue('drupal.site.name'))
      ->option('site-mail', $this->getConfigValue('drupal.site.mail'))
      ->option('account-name', $username, '=')
      ->option('account-pass', $password, '=')
      ->option('account-mail', $mail)
      ->option('db-url', $db_url)
      ->option('locale', $this->getConfigValue('drupal.site.locale'))
      ->printOutput(TRUE);

    return $task;
  }

}
