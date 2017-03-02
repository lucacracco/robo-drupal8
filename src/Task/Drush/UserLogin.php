<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

use Robo\Common\IO;

/**
 * Robo task: Display one-time login URL.
 */
class UserLogin extends DrushTask {

  use IO;

  /**
   * User
   *
   * @var int|string
   */
  protected $user;

  /**
   * Constructor.
   *
   * @param int|string $user
   *   An optional uid, user name, or email address for the user to log in
   *   (defaults to user ID '1').
   */
  public function __construct($user = 1) {
    parent::__construct();
    $this->user = $user;
  }

  /**
   * {@inheritdoc}
   */
  public function run() {
    $this->yell('Login URL', 20);

    return $this->drushStack()
      ->argForNextCommand(escapeshellarg($this->user))
      ->optionForNextCommand('no-browser')
      ->drush('user-login')
      ->run();
  }

}
