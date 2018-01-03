<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "drupal:*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Setup
 */
class InstallCommand extends RoboDrupal8Tasks {

  /**
   * Installs Drupal.
   *
   * @command internal:drupal:install
   *
   * @validateMySqlAvailable
   *
   * @return \Robo\Result
   *   The `drush site-install` command result.
   *
   * @throws \Robo\Exception\TaskException
   */
  public function install() {
    return $this->baseInstall()->detectInteractive()->run();
  }

  /**
   * Get base install TaskCommand.
   *
   * @return \Lucacracco\RoboDrupal8\Robo\Tasks\DrushTask
   */
  protected function baseInstall() {
    $username = 'admin';
    $password = 'admin';

    /** @var \Lucacracco\RoboDrupal8\Robo\Tasks\DrushTask $task */
    $task = $this->taskDrush()
      ->drush("site-install")
      ->arg($this->getConfigValue('project.profile.name'))
      ->rawArg("install_configure_form.update_status_module='array(FALSE,FALSE)'")
      ->rawArg("install_configure_form.enable_update_status_module=NULL")
      ->option('site-name', $this->getConfigValue('project.human_name'))
      ->option('site-mail', $this->getConfigValue('drupal.account.mail'))
      ->option('account-name', $username, '=')
      ->option('account-password', $password, '=')
      ->option('account-mail', $this->getConfigValue('drupal.account.mail'))
      ->option('locale', $this->getConfigValue('drupal.locale'))
      ->assume(TRUE)
      ->printOutput(TRUE);

    return $task;
  }

  /**
   * Installs Drupal and imports configuration.
   *
   * @command internal:drupal:install-config
   *
   * @validateMySqlAvailable
   *
   * @return \Robo\Result
   *   The `drush site-install` command result.
   */
  public function installWithConfig() {
    $task = $this->baseInstall();
    $cm_core_key = $this->getConfigValue('cm.core.key');
    $task->option('config-dir', $this->getConfigValue("cm.core.dirs.$cm_core_key.path"));
    return $task->detectInteractive()->run();
  }

}