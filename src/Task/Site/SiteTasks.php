<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

/**
 * Class SiteTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task\Site
 */
class SiteTasks extends SiteBaseTasks {

  /**
   * Print site status.
   *
   * @return $this
   */
  public function status() {
    $this->collection->add(
      $this->collectionBuilder()->taskDrushCoreStatus($this->config)
    );
    return $this;
  }

  /**
   * Set maintenance mode.
   *
   * @param boolean $status
   *   Active or not.
   *
   * @return $this
   */
  public function maintenanceMode($status) {
//    $this->collection->addCode(function () use($status) {
//      $message = 'Set maintenance mode ' . ($status ? 'on' : 'off');
//      $this->printTaskInfo($message);
//    });
    $this->collection->add(
      $this->collectionBuilder()
        ->taskDrushStateSet('system.maintenance_mode', $status ? 1 : 0, 'integer')
    );
    return $this;
  }

  /**
   * Tasks collection for clear cache, import config, update database pedings, schema and translations.
   *
   * @return $this
   */
  public function updateAll() {
    $modules_dev = $this->config->get('drupal.site.modules_dev', []);
    $task_list = [
      // Clear all caches.
      'cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild($this->config),
      // Import configuration.
      'configImport' => $this->collectionBuilder()
        ->taskDrushConfigImport(FALSE, $modules_dev, $this->config),
      // Apply database updates.
      'applyDatabaseUpdates' => $this->collectionBuilder()
        ->taskDrushApplyDatabaseUpdates($this->config),
      // Import configuration (again, to ensure no stale configuration updates).
      'configImportAgain' => $this->collectionBuilder()
        ->taskDrushConfigImport(FALSE, $modules_dev, $this->config),
      // Apply entity schema updates.
      'applyEntitySchemaUpdates' => $this->collectionBuilder()
        ->taskDrushEntitySchemaUpdates($this->config),
      // Clear all caches (again).
      'rebuildCache' => $this->collectionBuilder()
        ->taskDrushCacheRebuild($this->config),
      // Update translations.
      'localeUpdate' => $this->collectionBuilder()
        ->taskDrushLocaleUpdate($this->config),
    ];

    // TODO: TaskList or use one task with call each function?
    $this->collection->addTaskList($task_list);
    return $this;
  }

  /**
   * Tasks collection for clear cache, import config, update database pendings and schema.
   *
   * @return $this
   */
  public function updateConfig() {
    $modules_dev = $this->config->get('drupal.site.modules_dev', []);
    $task_list = [
      // Clear all caches.
      'cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild($this->config),
      // Import configuration.
      'configImport' => $this->collectionBuilder()
        ->taskDrushConfigImport(FALSE, $modules_dev, $this->config),
      // Apply database updates.
      'applyDatabaseUpdates' => $this->collectionBuilder()
        ->taskDrushApplyDatabaseUpdates($this->config),
      // Import configuration (again, to ensure no stale configuration updates).
      'configImportAgain' => $this->collectionBuilder()
        ->taskDrushConfigImport(FALSE, $modules_dev, $this->config),
      // Apply entity schema updates.
      'applyEntitySchemaUpdates' => $this->collectionBuilder()
        ->taskDrushEntitySchemaUpdates($this->config),
      // Clear all caches (again).
      'cacheRebuildAgain' => $this->collectionBuilder()
        ->taskDrushCacheRebuild($this->config),
    ];

    // TODO: TaskList or use one task with call each function?
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
   * Task collection for check and install composer vendors.
   *
   * @param string $dir
   *
   * @return $this
   */
  public function composerInstall($dir) {
    $this->collection->add(
      $this->collectionBuilder()
        ->taskComposerInstall()
        ->dir($dir)
        ->option('optimize-autoloader')
        ->option('prefer-dist'),
      'composerInstall'
    );
    return $this;
  }

  /**
   * Tasks collection for clear files and structure site.
   *
   * @return $this
   */
  public function clearFilesSite() {
    $this->collection->add($this->collectionBuilder()->taskFilesystemStack()
      ->chmod($this->siteDir, 0775, 0000, TRUE)
      ->chmod($this->siteDir, 0775)
      ->remove($this->siteDir . '/files')
      ->remove($this->siteDir . '/settings.php')
      ->remove($this->siteDir . '/services.yml')
    );
    return $this;
  }

  /**
   * Tasks collection for init files and structure site.
   *
   * @return $this
   */
  public function createFilesSite() {
    $this->collection->add(
      $this->collectionBuilder()->taskFilesystemStack()
        ->chmod($this->siteDir, 0775, 0000, TRUE)
        ->mkdir($this->siteDir . '/files')
        ->chmod($this->siteDir . '/files', 0775, 0000, TRUE)
        ->copy($this->siteDir . '/default.settings.php', $this->siteDir . '/settings.php')
        ->copy($this->siteDir . '/default.services.yml', $this->siteDir . '/services.yml')
    );
    return $this;
  }

  /**
   * Build new.
   *
   * @param array $settings
   *   Contains settings to include in installation.
   *
   * @return $this
   */
  public function buildNew($settings = []) {
    $task_list = [
      'composerInstall' => $this->composerInstall($this->root),
      'clearFilesSite' => $this->clearFilesSite()->createFilesSite(),
      'createFilesSite' => $this->createFilesSite(),
      'buildNew' => $this->collectionBuilder()
        ->taskDrushInstall(
          $this->config->get('drupal.site.name'),
          $this->config->get('drupal.site.mail'),
          $this->config->get('drupal.site.admin.mail'),
          $this->config->get('drupal.site.admin.name'),
          $this->config->get('drupal.site.admin.password'),
          $this->config->get('drupal.databases.default.url'),
          $this->config->get('drupal.site.local', 'en'),
          $this->config->get('drupal.site.sub_dir', 'default'),
          $this->config->get('drupal.site.profile', 'standard'),
          $settings,
          $this->config
        ),
      'siteSettingsConfigure' => $this->updateSettings(),
      'setConfigUuid' => $this->collectionBuilder()
        ->taskDrushSetConfig("system.site", "uuid", $this->config->get('drupal.site.uuid')),
      'cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild($this->config),
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

  /**
   * Build site from configurations folder.
   *
   * @param array $settings
   *   Contains settings to include in installation.
   *
   * @return $this
   */
  public function buildConf($settings = []) {
    $task_list = [
      'composerInstall' => $this->composerInstall($this->root),
      'clearFilesSite' => $this->clearFilesSite()->createFilesSite(),
      'createFilesSite' => $this->createFilesSite(),
      'buildNew' => $this->collectionBuilder()
        ->taskDrushInstall(
          $this->config->get('drupal.site.name'),
          $this->config->get('drupal.site.mail'),
          $this->config->get('drupal.site.admin.mail'),
          $this->config->get('drupal.site.admin.name'),
          $this->config->get('drupal.site.admin.password'),
          $this->config->get('drupal.databases.default.url'),
          $this->config->get('drupal.site.local', 'en'),
          $this->config->get('drupal.site.sub_dir', 'default'),
          "minimal" .
          $settings,
          $this->config
        ),
      'siteSettingsConfigure' => $this->updateSettings(),
      'setConfigUuid' => $this->collectionBuilder()
        ->taskDrushSetConfig("system.site", "uuid", $this->config->get('drupal.site.uuid')),
      'cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild($this->config),
      'updateConfig' => $this->updateConfig(),
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

  /**
   * Build site from configurations folder with 'config_installer'.
   *
   * @param array $settings
   *   Contains settings to include in installation.
   *
   * @return $this
   */
  public function buildConfigInstaller($settings = []) {
    $task_list = [
      'composerInstall' => $this->composerInstall($this->root),
      // TODO: composer required drupal/config_installer!
      'clearFilesSite' => $this->clearFilesSite()->createFilesSite(),
      'createFilesSite' => $this->createFilesSite(),
      'buildNew' => $this->collectionBuilder()
        ->taskDrushInstall(
          $this->config->get('drupal.site.name'),
          $this->config->get('drupal.site.mail'),
          $this->config->get('drupal.site.admin.mail'),
          $this->config->get('drupal.site.admin.name'),
          $this->config->get('drupal.site.admin.password'),
          $this->config->get('drupal.databases.default.url'),
          $this->config->get('drupal.site.local', 'en'),
          $this->config->get('drupal.site.sub_dir', 'default'),
          "config_installer",
          $settings,
          $this->config
        ),
      'siteSettingsConfigure' => $this->updateSettings(),
      'setConfigUuid' => $this->collectionBuilder()
        ->taskDrushSetConfig("system.site", "uuid", $this->config->get('drupal.site.uuid')),
      'cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild($this->config),
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

  /**
   * Build site from backup.
   *
   * @param string $dump
   *   Path of dump to load.
   * @param array $settings
   *   Contains settings to include in installation.
   * @return $this
   */
  public function buildFromDatabase($dump, $settings = []) {
    $task_list = [
      'composerInstall' => $this->composerInstall($this->root),
      'clearFilesSite' => $this->clearFilesSite()->createFilesSite(),
      'createFilesSite' => $this->createFilesSite(),
      'buildNew' => $this->collectionBuilder()
        ->taskDrushInstall(
          $this->config->get('drupal.site.name'),
          $this->config->get('drupal.site.mail'),
          $this->config->get('drupal.site.admin.mail'),
          $this->config->get('drupal.site.admin.name'),
          $this->config->get('drupal.site.admin.password'),
          $this->config->get('drupal.databases.default.url'),
          $this->config->get('drupal.site.local', 'en'),
          $this->config->get('drupal.site.sub_dir', 'default'),
          "minimal" .
          $settings,
          $this->config
        ),
      'siteSettingsConfigure' => $this->updateSettings(),
      'setConfigUuid' => $this->collectionBuilder()
        ->taskDrushSetConfig("system.site", "uuid", $this->config->get('drupal.site.uuid')),
      'cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild($this->config),
      'updateConfig' => $this->taskDrushDumpImport($dump),
      'cacheRebuildAfeterImportDump' => $this->collectionBuilder()
        ->taskDrushCacheRebuild($this->config),
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
