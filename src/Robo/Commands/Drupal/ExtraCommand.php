<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Provides commands in the "drupal:extra:*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Comamnds\Drupal
 */
class ExtraCommand extends RoboDrupal8Tasks {

  /**
   * Display one-time login url.
   *
   * @command drupal:extra:login-one-time-url
   *
   * @option name A user name to log in as. If not provided, defaults to uid=1.
   *
   * @validateDrupalIsInstalled
   */
  public function loginOneTimeUrl($opts = ['name' => '1']) {
    $this->taskDrush()
      ->drush('user-login')
      ->option('name', $opts['name'])
      ->option('no-browser')
      ->printOutput(TRUE)
      ->run();
  }

}
