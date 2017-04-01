<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

use Lucacracco\Drupal8\Robo\Utility\Configurations;
use Robo\Collection\Collection;

/**
 * Robo task: Install Drupal.
 */
class Install extends DrushTask {

  /**
   * Build a new site.
   */
  public function buildNew() {
    $configurationsSite = Configurations::get('drupal.site');
    $configurationsAdmin = Configurations::get('drupal.site.admin');
    $configurationsDatabase = Configurations::get('drupal.databases.default');

    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand('--site-name=' . $configurationsSite['name'])
        ->argForNextCommand('--site-mail=' . $configurationsSite['mail'])
        ->argForNextCommand('--account-mail=' . $configurationsAdmin['mail'])
        ->argForNextCommand('--account-name=' . $configurationsAdmin['name'])
        ->argForNextCommand('--account-pass=' . $configurationsAdmin['pass'])
        ->argForNextCommand('--db-url=' . $configurationsDatabase['url'])
        ->argForNextCommand('--locale=' . $configurationsSite['locale'])
        ->argForNextCommand('--sites-subdir=' . $configurationsSite['sub_dir'])
        ->drush('site-install ' . $configurationsSite['profile'])
    );

    return $this;
  }

  /**
   * Build a new site.
   */
  public function buildProfile($profile) {
    $configurationsSite = Configurations::get('drupal.site');
    $configurationsAdmin = Configurations::get('drupal.site.admin');
    $configurationsDatabase = Configurations::get('drupal.databases.default');

    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand('--site-name=' . $configurationsSite['name'])
        ->argForNextCommand('--site-mail=' . $configurationsSite['mail'])
        ->argForNextCommand('--account-mail=' . $configurationsAdmin['mail'])
        ->argForNextCommand('--account-name=' . $configurationsAdmin['name'])
        ->argForNextCommand('--account-pass=' . $configurationsAdmin['pass'])
        ->argForNextCommand('--db-url=' . $configurationsDatabase['url'])
        ->argForNextCommand('--locale=' . $configurationsSite['locale'])
        ->argForNextCommand('--sites-subdir=' . $configurationsSite['sub_dir'])
        ->drush('site-install ' . $profile)
    );

    return $this;
  }


}
