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
   *
   * @interactMySqlConnection
   * @interactDrupalIsAlreadyInstalled
   *
   * @validateDocrootIsPresent
   */
  public function drupalInstallScratch() {
    $this->invokeCommand('composer:install');
    $this->install()->detectInteractive()->run();
    $this->invokeCommands([
      'drupal:settings',
      'drupal:update',
      'drupal:filesystem:protect-site',
      'drupal:core-cron',
      'drupal:extra:login-one-time-url',
    ]);
  }

  /**
   * Install from configuration.
   *
   * @command drupal:install-from-config
   *
   * @interactMySqlConnection
   * @interactDrupalIsAlreadyInstalled
   *
   * @validateMySqlAvailable
   * @validateDocrootIsPresent
   */
  public function drupalInstallFromConfig() {
    $this->invokeCommands([
      'composer:install',
      'drupal:settings',
    ]);
    $this->installWithConfig()->detectInteractive()->run();
    $this->invokeCommands([
      'drupal:update',
      'drupal:filesystem:protect-site',
      'drupal:core-cron',
      'drupal:extra:login-one-time-url',
    ]);
  }

  /**
   * Installs Drupal and imports configuration.
   *
   * @return \Lucacracco\RoboDrupal8\Robo\Tasks\DrushTask
   */
  protected function installWithConfig() {
    $task = $this->install('config_installer');
    $task->option('config-dir', $this->getConfigValue("drupal.config_directories.sync"));
    return $task;
  }

  /**
   * Get base install TaskCommand.
   *
   * @return \Lucacracco\RoboDrupal8\Robo\Tasks\DrushTask
   */
  protected function install($profile = '') {

    $username = $this->getConfigValue('drupal.account.username', 'admin');
    $password = $this->getConfigValue('drupal.account.password', 'admin');
    $mail = $this->getConfigValue('drupal.account.mail', 'admin@localhost');

    $profile = empty($profile) ? $this->getConfigValue('drupal.site.profile', 'minimal') : $profile;

    $db_url = MySqlConnection::convertDatabaseFromDatabaseArray($this->getConfigValue('drupal.database'));

    /** @var \Lucacracco\RoboDrupal8\Robo\Tasks\DrushTask $task */
    $task = $this->taskDrush()
      ->drush("site-install")
      ->arg($profile)
      ->rawArg("install_configure_form.update_status_module='array(FALSE,FALSE)'")
      ->rawArg("install_configure_form.enable_update_status_module=NULL")
      ->option('site-name', $this->getConfigValue('project.human_name'))
      ->option('site-mail', $this->getConfigValue('drupal.site.mail'))
      ->option('account-name', $username, '=')
      ->option('account-pass', $password, '=')
      ->option('account-mail', $mail)
      ->option('db-url', $db_url)
      ->option('locale', $this->getConfigValue('drupal.locale'))
      ->printOutput(TRUE);

    return $task;
  }

}
