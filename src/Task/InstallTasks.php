<?php

namespace Lucacracco\Drupal8\Robo\Task;

/**
 * Class InstallTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task
 */
class InstallTasks extends BaseTasks {

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
      'clearFilesSite' => $this->collectionBuilder()
        ->taskDrupalFileSystemTasks()
        ->clearFilesSite(),
      'createFilesSite' => $this->collectionBuilder()
        ->taskDrupalFileSystemTasks()
        ->createFilesSite(),
      'install' => $this->drushStack()
        ->argForNextCommand('--site-name=' . $this->config->get('drupal.site.name'))
        ->argForNextCommand('--site-mail=' . $this->config->get('drupal.site.mail'))
        ->argForNextCommand('--account-mail=' . $this->config->get('drupal.site.admin.mail'))
        ->argForNextCommand('--account-name=' . $this->config->get('drupal.site.admin.name'))
        ->argForNextCommand('--account-pass=' . $this->config->get('drupal.site.admin.pass'))
        ->argForNextCommand('--db-url=' . $this->config->get('drupal.databases.default.url'))
        ->argForNextCommand('--locale=' . $this->config->get('drupal.site.local', 'en'))
        ->argForNextCommand('--sites-subdir=' . $this->config->get('drupal.site.sub_dir', 'default'))
        ->drush('site-install ' . $this->config->get('drupal.site.profile', 'standard') . " " . implode(' ', $settings)),
      'updateSettings' => $this->collectionBuilder()
        ->taskDrupalMaintenanceTasks()
        ->updateSettings(),
      'setConfigUuid' => $this->drushStack()
        ->argForNextCommand("system.site")
        ->argForNextCommand("uuid")
        ->argForNextCommand($this->config->get('drupal.site.uuid'))
        ->drush('config-set'),
      'cacheRebuild' => $this->drushStack()
        ->drush('cache-rebuild'),
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
      'clearFilesSite' => $this->collectionBuilder()
        ->taskDrupalFileSystemTasks()
        ->clearFilesSite(),
      'createFilesSite' => $this->collectionBuilder()
        ->taskDrupalFileSystemTasks()
        ->createFilesSite(),
      'install' => $this->drushStack()
        ->argForNextCommand('--site-name=' . $this->config->get('drupal.site.name'))
        ->argForNextCommand('--site-mail=' . $this->config->get('drupal.site.mail'))
        ->argForNextCommand('--account-mail=' . $this->config->get('drupal.site.admin.mail'))
        ->argForNextCommand('--account-name=' . $this->config->get('drupal.site.admin.name'))
        ->argForNextCommand('--account-pass=' . $this->config->get('drupal.site.admin.pass'))
        ->argForNextCommand('--db-url=' . $this->config->get('drupal.databases.default.url'))
        ->argForNextCommand('--locale=' . $this->config->get('drupal.site.local', 'en'))
        ->argForNextCommand('--sites-subdir=' . $this->config->get('drupal.site.sub_dir', 'default'))
        ->drush('site-install ' . $this->config->get('drupal.site.profile', 'standard') . " " . implode(' ', $settings)),
      'updateSettings' => $this->collectionBuilder()
        ->taskDrupalMaintenanceTasks()
        ->updateSettings(),
      'setConfigUuid' => $this->drushStack()
        ->argForNextCommand("system.site")
        ->argForNextCommand("uuid")
        ->argForNextCommand($this->config->get('drupal.site.uuid'))
        ->drush('config-set'),
      'cacheRebuild' => $this->drushStack()
        ->drush('cache-rebuild'),
      'updateConfig' => $this->collectionBuilder()
        ->taskDrupalConfigurationsTasks()
        ->configurationImport(),
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
      'clearFilesSite' => $this->collectionBuilder()
        ->taskDrupalFileSystemTasks()
        ->clearFilesSite(),
      'createFilesSite' => $this->collectionBuilder()
        ->taskDrupalFileSystemTasks()
        ->createFilesSite(),
      'install' => $this->drushStack()
        ->argForNextCommand('--site-name=' . $this->config->get('drupal.site.name'))
        ->argForNextCommand('--site-mail=' . $this->config->get('drupal.site.mail'))
        ->argForNextCommand('--account-mail=' . $this->config->get('drupal.site.admin.mail'))
        ->argForNextCommand('--account-name=' . $this->config->get('drupal.site.admin.name'))
        ->argForNextCommand('--account-pass=' . $this->config->get('drupal.site.admin.pass'))
        ->argForNextCommand('--db-url=' . $this->config->get('drupal.databases.default.url'))
        ->argForNextCommand('--locale=' . $this->config->get('drupal.site.local', 'en'))
        ->argForNextCommand('--sites-subdir=' . $this->config->get('drupal.site.sub_dir', 'default'))
        ->drush('site-install config_installer ' . implode(' ', $settings)),
      'updateSettings' => $this->collectionBuilder()
        ->taskDrupalMaintenanceTasks()
        ->updateSettings(),
      'setConfigUuid' => $this->drushStack()
        ->argForNextCommand("system.site")
        ->argForNextCommand("uuid")
        ->argForNextCommand($this->config->get('drupal.site.uuid'))
        ->drush('config-set'),
      'cacheRebuild' => $this->drushStack()
        ->drush('cache-rebuild'),
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
      'clearFilesSite' => $this->collectionBuilder()
        ->taskDrupalFileSystemTasks()
        ->clearFilesSite(),
      'createFilesSite' => $this->collectionBuilder()
        ->taskDrupalFileSystemTasks()
        ->createFilesSite(),
      'install' => $this->drushStack()
        ->argForNextCommand('--site-name=' . $this->config->get('drupal.site.name'))
        ->argForNextCommand('--site-mail=' . $this->config->get('drupal.site.mail'))
        ->argForNextCommand('--account-mail=' . $this->config->get('drupal.site.admin.mail'))
        ->argForNextCommand('--account-name=' . $this->config->get('drupal.site.admin.name'))
        ->argForNextCommand('--account-pass=' . $this->config->get('drupal.site.admin.pass'))
        ->argForNextCommand('--db-url=' . $this->config->get('drupal.databases.default.url'))
        ->argForNextCommand('--locale=' . $this->config->get('drupal.site.local', 'en'))
        ->argForNextCommand('--sites-subdir=' . $this->config->get('drupal.site.sub_dir', 'default'))
        ->drush('site-install ' . $this->config->get('drupal.site.profile', 'standard') . " " . implode(' ', $settings)),
      'updateSettings' => $this->collectionBuilder()
        ->taskDrupalMaintenanceTasks()
        ->updateSettings(),
      'setConfigUuid' => $this->drushStack()
        ->argForNextCommand("system.site")
        ->argForNextCommand("uuid")
        ->argForNextCommand($this->config->get('drupal.site.uuid'))
        ->drush('config-set'),
      // TODO: import database.
      'updateConfig' => $this->taskDrushDumpImport($dump),
      'cacheRebuild' => $this->drushStack()
        ->drush('cache-rebuild'),
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

}