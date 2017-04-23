<?php

namespace Lucacracco\Drupal8\Robo\Task;

use Lucacracco\Drupal8\Robo\Utility\PathResolver;

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
      'composerInstall' => $this->collectionBuilder()
        ->taskComposerInstall()
        ->dir(PathResolver::getProjectPath())
        ->option('optimize-autoloader')
        ->option('prefer-dist'),
      'clearFilesSite' => $this->collectionBuilder()
        ->taskFileSystemTasks()
        ->clearFilesSite(),
      'createFilesSite' => $this->collectionBuilder()
        ->taskFileSystemTasks()
        ->createFilesSite(),
      'install' => $this->drushStack()
        ->argForNextCommand('--site-name=' . $this->config->get('drupal.site.name'))
        ->argForNextCommand('--site-mail=' . $this->config->get('drupal.site.mail'))
        ->argForNextCommand('--account-mail=' . $this->config->get('drupal.site.admin.mail'))
        ->argForNextCommand('--account-name=' . $this->config->get('drupal.site.admin.name'))
        ->argForNextCommand('--account-pass=' . $this->config->get('drupal.site.admin.password'))
        ->argForNextCommand('--db-url=' . $this->config->get('drupal.databases.default.url'))
        ->argForNextCommand('--locale=' . $this->config->get('drupal.site.local', 'en'))
        ->argForNextCommand('--sites-subdir=' . $this->config->get('drupal.site.sub_dir', 'default'))
        ->drush('site-install ' . $this->config->get('drupal.site.profile', 'standard') . " " . implode(' ', $settings)),
      'siteSettingsConfigure' => $this->collectionBuilder()
        ->taskSiteUpdateSettings(),
      'setConfigUuid' => $this->collectionBuilder()
        ->taskDrushConfigSet("system.site", "uuid", $this->config->get('drupal.site.uuid')),
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
      'composerInstall' => $this->collectionBuilder()
        ->taskComposerInstall()
        ->dir(PathResolver::getProjectPath())
        ->option('optimize-autoloader')
        ->option('prefer-dist'),
      'clearFilesSite' => $this->collectionBuilder()
        ->taskFileSystemTasks()
        ->clearFilesSite(),
      'createFilesSite' => $this->collectionBuilder()
        ->taskFileSystemTasks()
        ->createFilesSite(),
      'install' => $this->drushStack()
        ->argForNextCommand('--site-name=' . $this->config->get('drupal.site.name'))
        ->argForNextCommand('--site-mail=' . $this->config->get('drupal.site.mail'))
        ->argForNextCommand('--account-mail=' . $this->config->get('drupal.site.admin.mail'))
        ->argForNextCommand('--account-name=' . $this->config->get('drupal.site.admin.name'))
        ->argForNextCommand('--account-pass=' . $this->config->get('drupal.site.admin.password'))
        ->argForNextCommand('--db-url=' . $this->config->get('drupal.databases.default.url'))
        ->argForNextCommand('--locale=' . $this->config->get('drupal.site.local', 'en'))
        ->argForNextCommand('--sites-subdir=' . $this->config->get('drupal.site.sub_dir', 'default'))
        ->drush('site-install ' . $this->config->get('drupal.site.profile', 'standard') . " " . implode(' ', $settings)),
      'siteSettingsConfigure' => $this->updateSettings(),
      'setConfigUuid' => $this->collectionBuilder()
        ->taskDrushConfigSet("system.site", "uuid", $this->config->get('drupal.site.uuid')),
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
      'composerInstall' => $this->collectionBuilder()
        ->taskComposerInstall()
        ->dir(PathResolver::getProjectPath())
        ->option('optimize-autoloader')
        ->option('prefer-dist'),
      // TODO: composer required drupal/config_installer.
      'clearFilesSite' => $this->collectionBuilder()
        ->taskFileSystemTasks()
        ->clearFilesSite(),
      'createFilesSite' => $this->collectionBuilder()
        ->taskFileSystemTasks()
        ->createFilesSite(),
      'install' => $this->drushStack()
        ->argForNextCommand('--site-name=' . $this->config->get('drupal.site.name'))
        ->argForNextCommand('--site-mail=' . $this->config->get('drupal.site.mail'))
        ->argForNextCommand('--account-mail=' . $this->config->get('drupal.site.admin.mail'))
        ->argForNextCommand('--account-name=' . $this->config->get('drupal.site.admin.name'))
        ->argForNextCommand('--account-pass=' . $this->config->get('drupal.site.admin.password'))
        ->argForNextCommand('--db-url=' . $this->config->get('drupal.databases.default.url'))
        ->argForNextCommand('--locale=' . $this->config->get('drupal.site.local', 'en'))
        ->argForNextCommand('--sites-subdir=' . $this->config->get('drupal.site.sub_dir', 'default'))
        ->drush('site-install config_installer ' . implode(' ', $settings)),
      'siteSettingsConfigure' => $this->updateSettings(),
      'setConfigUuid' => $this->collectionBuilder()
        ->taskDrushConfigSet("system.site", "uuid", $this->config->get('drupal.site.uuid')),
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
      'composerInstall' => $this->collectionBuilder()
        ->taskComposerInstall()
        ->dir(PathResolver::getProjectPath())
        ->option('optimize-autoloader')
        ->option('prefer-dist'),
      'clearFilesSite' => $this->collectionBuilder()
        ->taskFileSystemTasks()
        ->clearFilesSite(),
      'createFilesSite' => $this->collectionBuilder()
        ->taskFileSystemTasks()
        ->createFilesSite(),
      'install' => $this->drushStack()
        ->argForNextCommand('--site-name=' . $this->config->get('drupal.site.name'))
        ->argForNextCommand('--site-mail=' . $this->config->get('drupal.site.mail'))
        ->argForNextCommand('--account-mail=' . $this->config->get('drupal.site.admin.mail'))
        ->argForNextCommand('--account-name=' . $this->config->get('drupal.site.admin.name'))
        ->argForNextCommand('--account-pass=' . $this->config->get('drupal.site.admin.password'))
        ->argForNextCommand('--db-url=' . $this->config->get('drupal.databases.default.url'))
        ->argForNextCommand('--locale=' . $this->config->get('drupal.site.local', 'en'))
        ->argForNextCommand('--sites-subdir=' . $this->config->get('drupal.site.sub_dir', 'default'))
        ->drush('site-install ' . $this->config->get('drupal.site.profile', 'standard') . " " . implode(' ', $settings)),
      'siteSettingsConfigure' => $this->updateSettings(),
      'setConfigUuid' => $this->collectionBuilder()
        ->taskDrushConfigSet("system.site", "uuid", $this->config->get('drupal.site.uuid')),
      'cacheRebuild' => $this->collectionBuilder()
        ->taskDrushCacheRebuild($this->config),
      'updateConfig' => $this->taskDrushDumpImport($dump),
      'cacheRebuildAfeterImportDump' => $this->collectionBuilder()
        ->taskDrushCacheRebuild($this->config),
    ];
    $this->collection->addTaskList($task_list);
    return $this;
  }

}