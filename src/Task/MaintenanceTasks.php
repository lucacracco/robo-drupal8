<?php

namespace Lucacracco\Drupal8\Robo\Task;

/**
 * Class MaintenanceTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task
 */
class MaintenanceTasks extends BaseTasks {

  /**
   * Set maintenance mode.
   *
   * @param boolean $status
   *   Active or not.
   *
   * @return $this
   */
  public function maintenanceMode($status) {
    $task_list = [
      'configSet' => $this->drushStack()
        ->argForNextCommand(escapeshellarg($status ? '1' : '0'))
        ->drush("config-set system maintenance_mode"),
      'cacheRebuild' => $this->drushStack()->drush('cache-rebuild'),
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

  /**
   * Print site status.
   *
   * @param string $format
   *   Format of output.
   *
   * @return $this
   */
  public function status($format = 'json') {
    $task_list = [
      'cacheRebuild' => $this->drushStack()->drush('cache-rebuild'),
      'siteStatus' => $this->drushStack()
        ->argForNextCommand('--format=' . escapeshellarg($format))
        ->drush('core-status')
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

  /**
   * Tasks collection for clear cache, import config, update database pedings, schema and translations.
   *
   * @return $this
   */
  public function updateAll() {

    $task_list = [
      'cacheRebuild' => $this->drushStack()->drush('cache-rebuild'),
      'configurationsSiteImport' => $this->collectionBuilder()
        ->taskConfigurationsSiteTask($this->config)
        ->configurationImport(),
      'updateDatabase' => $this->drushStack()
        ->optionForNextCommand('updatedb')
        ->drush('updatedb'),
      'configurationsSiteImportAgain' => $this->collectionBuilder()
        ->taskConfigurationsSiteTask($this->config)
        ->configurationImport(),
      'entityUpdates' => $this->drushStack()
        ->optionForNextCommand('entity-updates')
        ->drush('updatedb'),
      'cacheRebuildAgain' => $this->drushStack()->drush('cache-rebuild'),
      'localeUpdate' => $this->drushStack()
        ->drush('locale-update')
    ];

    $this->collection->addTaskList($task_list);
    return $this;
  }

  /**
   * Update settings.
   *
   * @return $this
   */
  public function updateSettings() {
    $settings = [];
    $path_settings = $this->siteDir . DIRECTORY_SEPARATOR . "settings.php";
    $databases = $this->config->get('drupal.databases');

    foreach ($databases as $database_key => $database_info) {
      foreach ($this->convertDatabaseFromDatabaseUrl($database_info) as $key => $value) {
        $settings['drupal.databases.' . $database_key . '.' . $key] = $value;
      }
      // Insert manual the info of 'prefix' and 'namespace' because is not found in url.
      $settings['drupal.databases.' . $database_key . '.prefix'] = $database_info['prefix'];
      $settings['drupal.databases.' . $database_key . '.namespace'] = $database_info['namespace'];
    }

    // Save configurations new.
    foreach ($settings as $key => $value) {
      $this->config->set($key, $value);
    }

    $template_name = $this->config->get('drupal.site.tpl_settings');
    $templates_folder = $this->config->get('project.templates_dir');
    $twig_loader = new \Twig_Loader_Filesystem($templates_folder);
    $twig = new \Twig_Environment($twig_loader);
    $settings_rendered = $twig->render($template_name, $this->config->export());

    $task_list = [
      'Settings.chmod' => $this->collectionBuilder()
        ->taskFilesystemStack()
        ->chmod($path_settings, 0777),
      // TODO: remove and copy from default.settings.php
      'Settings.write' => $this->collectionBuilder()
        ->taskWriteToFile($path_settings)
        ->line($settings_rendered)
        ->append(),
      // TODO: chmod settings.php with ?? (0600)
    ];

    $this->collection->addTaskList($task_list);

    return $this;
  }

  /**
   *  Display one-time login URL.
   *
   * @param int $user_id
   *   User id.
   *
   * @return $this
   */
  public function loginOneTimeUrl($user_id = 1) {
    $task_list = [
      'configSet' => $this->drushStack()
        ->argForNextCommand(escapeshellarg($user_id))
        ->optionForNextCommand('no-browser')
        ->drush('user-login')
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }


  /**
   * Convert from an old-style database URL to an array of database settings.
   *
   * @param db_url
   *   A Drupal 6 db url string to convert, or an array with a 'default' element.
   * @return array
   *   An array of database values containing only the 'default' element of
   *   the db url. If the parse fails the array is empty.
   */
  private function convertDatabaseFromDatabaseUrl($database_info) {
    $db_url = $database_info['url'];
    $db_spec = [];

    if (is_array($db_url)) {
      $db_url_default = $db_url['default'];
    }
    else {
      $db_url_default = $db_url;
    }

    // If it's a sqlite database, pick the database path and we're done.
    if (strpos($db_url_default, 'sqlite://') === 0) {
      $db_spec = [
        'driver' => 'sqlite',
        'database' => substr($db_url_default, strlen('sqlite://')),
      ];
    }
    else {
      $url = parse_url($db_url_default);
      if ($url) {
        // Fill in defaults to prevent notices.
        $url += [
          'scheme' => NULL,
          'user' => NULL,
          'pass' => NULL,
          'host' => NULL,
          'port' => NULL,
          'path' => NULL,
          'prefix' => '',
          'namespace' => '',
        ];
        $url = (object) array_map('urldecode', $url);
        $db_spec = [
          'driver' => $url->scheme == 'mysqli' ? 'mysql' : $url->scheme,
          'username' => $url->user,
          'password' => $url->pass,
          'host' => $url->host,
          'port' => $url->port,
          'database' => ltrim($url->path, '/'),
          'prefix' => $url->prefix,
          'namespace' => $url->namespace,
        ];
      }
    }

    return $db_spec;
  }

}