<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Defines commands in the "drupal:*" namespace.
 */
class DrupalCommand extends RoboDrupal8Tasks {

  /**
   * Installs Drupal and imports configuration.
   *
   * @command internal:drupal:install
   *
   * @validateMySqlAvailable
   * @validateDrushConfig
   *
   * @return \Robo\Result
   *   The `drush site-install` command result.
   *
   * @throws \Exception
   * @throws \Robo\Exception\TaskException
   * @hidden
   */
  public function install() {

    // Generate a random, valid username.
    // @see \Drupal\user\Plugin\Validation\Constraint\UserNameConstraintValidator
    $username = RandomString::string(10, FALSE,
      function ($string) {
        return !preg_match('/[^\x{80}-\x{F7} a-z0-9@+_.\'-]/i', $string);
      },
      'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!#%^&*()_?/.,+=><'
    );

    /** @var \Lucacracco\RoboDrupal8\Robo\Tasks\DrushTask $task */
    $task = $this->taskDrush()
      ->drush("site-install")
      ->arg($this->getConfigValue('project.profile.name'))
      ->rawArg("install_configure_form.update_status_module='array(FALSE,FALSE)'")
      ->rawArg("install_configure_form.enable_update_status_module=NULL")
      ->option('site-name', $this->getConfigValue('project.human_name'))
      ->option('site-mail', $this->getConfigValue('drupal.account.mail'))
      ->option('account-name', $username, '=')
      ->option('account-mail', $this->getConfigValue('drupal.account.mail'))
      ->option('locale', $this->getConfigValue('drupal.locale'))
      ->verbose(TRUE)
      ->printOutput(TRUE);

    $result = $task->detectInteractive()->run();
    if ($result->wasSuccessful()) {
      $this->getConfig()->set('state.drupal.installed', TRUE);
    }
    else {
      throw new \Exception("Failed to install Drupal!");
    }

    return $result;
  }

}
