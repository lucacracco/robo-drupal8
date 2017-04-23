<?php

namespace Lucacracco\Drupal8\Robo\Task\Drush;

/**
 * Class DrushTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task\Drush
 */
class DrushTasks extends DrushBaseTasks {

  /**
   * Apply Database Updates.
   *
   * @return $this
   */
  public function applyDatabaseUpdates() {
    $this->collection->add(
      $this->drushStack()
        ->optionForNextCommand('entity-updates')
        ->drush('updatedb')
    );
    return $this;
  }

  /**
   * Apply Entity Schema Updates.
   * @return $this
   */
  public function applyEntitySchemaUpdates() {
    $this->collection->add(
      $this->drushStack()
        ->drush('entity-updates')
    );
    return $this;
  }

  /**
   * Cache Rebuild.
   *
   * @return $this
   */
  public function cacheRebuild() {
    $this->collection->add(
      $this->drushStack()
        ->drush('cache-rebuild')
    );
    return $this;
  }

  /**
   * Enable Extensions.
   *
   * @param array $extensions
   *   Array contains a modules to enable.
   *
   * @return $this
   */
  public function enableExtensions($extensions) {
    foreach ($extensions as $extension) {
      $this->drushStack()->argForNextCommand(escapeshellarg($extension));
    }
    $this->collection->add(
      $this->drushStack()->drush("pm-enable")
    );
    return $this;
  }

  /**
   * Locale Update.
   *
   * @return $this
   */
  public function localeUpdate() {
    $this->collection->add(
      $this->drushStack()
        ->drush('locale-update')
    );
    return $this;
  }

  /**
   * Sql Drop database.
   *
   * @return $this
   */
  public function sqlDrop() {
    $this->collection->add(
      $this->drushStack()
        ->drush('sql-drop')
    );
    return $this;
  }

  /**
   * Create Dump of database.
   *
   * @param $file_path
   *   Where to save dump.
   *
   * @return $this
   */
  public function sqlDumpExport($file_path) {

    $tables_exclude = [
      'cache_data',
      'cache_bootstrap',
      'cache_container',
      'cache_config',
      'cache_default',
      'cache_discovery',
      'cache_dynamic_page_cache',
      'cache_entity',
      'cache_menu',
      'cache_migrate',
      'cache_render',
      'cache_toolbar',
      'cachetags',
      'watchdog',
      'sessions',
    ];

    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand(' > ' . escapeshellarg($file_path) . ' ')
        ->argForNextCommand('ordered-dump')
        ->argForNextCommand('extra=--skip-comments')
        ->argForNextCommand('structure-tables-list=' . escapeshellarg(implode(',', $tables_exclude)))
        ->drush('sql-dump')
    );
    return $this;
  }

  /**
   * Import dump sql.
   *
   * @param string $file_path
   *   File to import
   *
   * @return $this
   */
  public function sqlDumpImport($file_path) {
    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand('< ' . escapeshellarg($file_path))
        ->drush('sql-cli')
    );
    return $this;
  }

  /**
   * Print a link for one-time login.
   *
   * @param int $user
   *   An optional uid, user name, or email address for the user to log in
   *   (defaults to user ID '1').
   * @return $this
   */
  public function userLogin($user = 1) {
    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand(escapeshellarg($user))
        ->optionForNextCommand('no-browser')
        ->drush('user-login')
    );
    return $this;
  }

  /**
   * Uninstall Extensions.
   *
   * @param array $extensions
   *   Array contains a modules to uninstall.
   *
   * @return $this
   */
  public function uninstallExtensions($extensions) {
    foreach ($extensions as $extension) {
      $this->drushStack()->argForNextCommand(escapeshellarg($extension));
    }
    $this->collection->add(
      $this->drushStack()->drush("pm-uninstall")
    );
    return $this;
  }

  /**
   * Set state Variable.
   *
   * @param string $key
   * @param string $value
   * @param string $format
   *
   * @return $this
   */
  public function stateSet($key, $value, $format = 'auto') {
    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand(escapeshellarg($key))
        ->argForNextCommand(escapeshellarg($value))
        ->argForNextCommand(escapeshellarg('format=' . $format))
        ->drush('state-set')
    );
    return $this;
  }

  /**
   * Core status.
   *
   * @param string $format
   *   Format of output.
   *
   * @return $this
   */
  public function coreStatus($format = 'json') {
    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand('--format=' . escapeshellarg($format))
        ->drush('core-status')
    );
    return $this;
  }

  /**
   * Set configuration.
   *
   * @param string $config_name
   *   The config object name, for example "system.site".
   * @param string $key
   *   The config key, for example "page.front".
   * @param $value
   *    The value to assign to the config key. Use '-' to read from STDIN.
   *
   * @return $this
   */
  public function configSet($config_name, $key, $value) {
    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand(escapeshellarg($value))
        ->drush("config-set \"{$config_name}\" \"$key\"")
    );
    return $this;
  }

  /**
   * Configuration Export.
   *
   * @param string $destination
   * @param array $skip_modules
   *
   * @return $this
   */
  public function configExport($destination, $skip_modules = []) {
    if (!empty($skip_modules)) {
      $this->drushStack()
        ->argForNextCommand("--skip-modules=" . implode(', ', $skip_modules));
    }
    if (isset($destination)) {
      $this->drushStack()
        ->argForNextCommand("--destination=" . $destination);
    }
    $this->collection->add(
      $this->drushStack()
        ->drush('config-export')
    );
    return $this;
  }

  /**
   * Configuration Import.
   *
   * @param bool $partial
   * @param array $skip_modules
   *
   * @return $this
   */
  public function configImport($partial = FALSE, $skip_modules = []) {
    if (!empty($skip_modules)) {
      $this->drushStack()
        ->argForNextCommand("--skip-modules=" . implode(', ', $skip_modules));
    }
    if ($partial) {
      $this->drushStack()
        ->argForNextCommand("--partial");
    }
    $this->collection->add(
      $this->drushStack()
        ->drush('config-import')
    );
    return $this;
  }

  /**
   * Install Drupal.
   *
   * @param $site_name
   * @param $site_mail
   * @param $account_mail
   * @param $account_name
   * @param $account_pass
   * @param $db_url
   * @param string $locale
   * @param string $site_sub_dir
   * @param string $profile
   * @param array $settings
   *
   * @return $this
   */
  public function install($site_name, $site_mail, $account_mail, $account_name, $account_pass, $db_url, $locale = "en", $site_sub_dir = "default", $profile = "standard", $settings = []) {
    $this->collection->add(
      $this->drushStack()
        ->argForNextCommand('--site-name=' . $site_name)
        ->argForNextCommand('--site-mail=' . $site_mail)
        ->argForNextCommand('--account-mail=' . $account_mail)
        ->argForNextCommand('--account-name=' . $account_name)
        ->argForNextCommand('--account-pass=' . $account_pass)
        ->argForNextCommand('--db-url=' . $db_url)
        ->argForNextCommand('--locale=' . $locale)
        ->argForNextCommand('--sites-subdir=' . $site_sub_dir)
        ->drush('site-install ' . $profile . " " . implode(' ', $settings))
    );
    return $this;
  }

}
