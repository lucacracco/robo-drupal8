<?php

/**
 * @file
 * Contains class with functionality for install drupal8 from yml configuration.
 */

namespace LucaCracco\Robo\Task\Drupal8;

use Boedah\Robo\Task\Drush\DrushStack;
use Robo\Common\Timer;
use Robo\Task\File\Write;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Unish\commandCase;

/**
 * Class Drupal8Functionality.
 *
 * @package LucaCracco\Robo\Task\Drupal8.
 */
class Drupal8Functionality {

  use LoadProperties;
  use TaskIO;
  use Timer;

  /**
   * Filesystem.
   *
   * @var Filesystem
   */
  protected $fs;

  /**
   * Twig Environment.
   *
   * @var \Twig_Environment
   */
  protected $twig;

  /**
   * Drupal8Stack constructor.
   *
   * @param string $environment
   *   Environment variable (local|stage|prod|custom1|..).
   * @param string $sub_dir
   *   Match to the sites that you want to start, useful for multi-site.
   *   In the case of a single installation to use/leave 'default'.
   *   Site (default|example1|..).
   * @param string $path_properties
   *   Absolute path where to find the configuration files.
   */
  public function __construct($environment = 'local', $sub_dir = 'default', $path_properties = 'build') {

    // Set Environment and site for load configuration file.
    $this->setEnvironment($environment);
    $this->setSite($sub_dir);
    $this->setPathProperties($path_properties);
    $this->properties = $this->getProperties();

    $loader = new Twig_Loader_Filesystem("{$this->getBasePath()}/{$this->pathProperties}/templates");
    $this->twig = new Twig_Environment($loader);
    $this->fs = new Filesystem();
  }

  /**
   * Print info site.
   */
  public function getInfoSite() {
    $this->say('Site Drupal Info');
    $this->getDrushWithUri()->status()->run();
  }

  /**
   * Setup file and directory for installation.
   *
   * Include:
   *  - clear file and directory site;
   *  - init file and directory site.
   */
  public function setupInstallation() {
    $this->clearFilesystem();
    $this->initFilesystem();
  }

  /**
   * Install Drupal.
   */
  public function install() {
    $this->say('Install Drupal');
    $properties = $this->properties;
    $this->getDrush()
      ->siteName($properties['site_configuration']['name'])
      ->siteMail($properties['site_configuration']['mail'])
      ->accountMail($properties['account']['mail'])
      ->accountName($properties['account']['name'])
      ->accountPass($properties['account']['pass'])
      ->mysqlDbUrl($properties['database']['url'])
      ->locale($properties['site_configuration']['locale'])
      ->sitesSubdir($properties['site_configuration']['sub_dir'])
      ->siteInstall($properties['site_configuration']['profile'])
      ->run();
  }

  /**
   * Install Drupal from config.
   *
   * TODO: update the current method of importing configurations!
   * Args <em>--config-dir</em>, that defined a path pointing to a full
   * set of configuration which should be imported after installation
   * (https://drushcommands.com/drush-8x/core/site-install/ ), not worked well.
   * Currently use <em>Configuration installer</em>
   * (https://www.drupal.org/project/config_installer)
   */
  public function installFromConfig() {

    $this->say('Install Drupal from Config');
    $properties = $this->properties;

    // Override properties.
    /* TODO: check if config_installer exist */
    /*
    if (!class_exists("\\Drupal\\config_installer\\Storage")) {

      $message = "Profile installation <em>Configuration installer</em>
        not found! Please download or include in your composer.json
        if you want to use function <em>InstallDrupalFromConfig</em>\n";
      $this->printTaskError($message);

      // TODO: create or use a exception better
      throw new Exception($message);
    }
    */
    $properties['site_configuration']['profile'] = 'config_installer';

    // Create settings.php: used from config_installer.
    /* TODO: remove this after change or update import configuration */
    $this->say('Create file settings.php');
    $site_path = "{$this->getSiteRoot()}/sites/{$this->properties['site_configuration']['sub_dir']}";
    $this->fs->copy("{$site_path}/default.settings.php", "{$site_path}/settings.php");
    $this->configureSettings();

    $this->getDrush()
      ->siteName($properties['site_configuration']['name'])
      ->siteMail($properties['site_configuration']['mail'])
      ->accountMail($properties['account']['mail'])
      ->accountName($properties['account']['name'])
      ->accountPass($properties['account']['pass'])
      ->mysqlDbUrl($properties['database']['url'])
      ->sitesSubdir($properties['site_configuration']['sub_dir'])
      /* ->args('--config-dir='.$properties['site_configuration']['config_dir']) */
      ->siteInstall($properties['site_configuration']['profile'])
      ->run();
  }

  /**
   * Clear Cache.
   */
  public function rebuildCache() {
    $this->say('Clear cache');
    $this->getDrushWithUri()
      ->exec('cache-rebuild')
      ->run();
  }

  /**
   * Execute Core cron.
   */
  public function coreCron() {
    $this->say('Core cron');
    $this->getDrushWithUri()
      ->exec('core-cron')
      ->run();
  }

  /**
   * Active theme.
   *
   * TODO: not complete.
   *
   * @param null|string $theme_name
   *   Name machine of theme to active.
   */
  public function activeTheme($theme_name = NULL) {

    if (!isset($theme_name)) {
      $theme_name = $this->properties['site_configuration']['theme_frontend'];
    }

    /*
     * TODO: set configuration drupal for active theme.
     */
  }

  /**
   * Install modules.
   *
   * @param string $type
   *   If you want install modules dev, pass variable string 'dev'.
   */
  public function installModules($type = 'normal') {

    /* TODO: print message error if not found category of modules passed */
    switch ($type) {
      case 'dev':
        $modules = $this->properties['modules_dev'];
        break;

      default:
        $modules = $this->properties['modules'];
    }

    // Convert array to string.
    $modules = implode(' ', $modules);

    $this->say('Install modules: ' . $modules);
    $this->getDrushWithUri()
      ->exec('pm-enable ' . $modules)
      ->run();
  }

  /**
   * Clears the directory structure for site.
   */
  public function clearFilesystem() {
    $this->say('Clears the directory structure for site');
    $base_path = "{$this->getSiteRoot()}/sites/{$this->properties['site_configuration']['sub_dir']}";
    $this->fs->chmod($base_path, 0775);
    $this->fs->remove($base_path . '/files');
    $this->fs->remove($base_path . '/settings.php');
  }

  /**
   * Creates the directory structure for site.
   */
  public function initFilesystem() {
    $this->say('Creates the directory structure for site');
    $base_path = "{$this->getSiteRoot()}/sites/{$this->properties['site_configuration']['sub_dir']}";
    $this->fs->chmod($base_path, 0775);
    $this->fs->mkdir($base_path . '/files', 0775);
    $this->fs->copy($base_path . '/default.settings.php', $base_path . '/settings.php');
    $this->fs->copy($base_path . '/default.services.yml', $base_path . '/services.yml');
  }

  /**
   * Setup correct permission for settings.php.
   */
  public function protectSite() {
    $base_path = "{$this->getSiteRoot()}/sites/{$this->properties['site_configuration']['sub_dir']}";
    $this->say('Protect settings.php');
    $this->fs->chmod($base_path . '/settings.php', 0755);
    $this->fs->chmod($base_path . '/services.yml', 0755);
    $this->fs->chmod($base_path, 0775);
  }

  /**
   * Configure settings.
   *
   * Using templates based on the name of the site and the environment,
   * update the settings file.
   *
   * TODO: load and use extra.build.*.*.yml configuration
   */
  public function configureSettings() {
    $this->say('Configure settings');

    /* $folder_templates = "{$this->getBasePath()}/{$this->pathProperties}/templates"; */
    $settings_file_path = "{$this->getSiteRoot()}/sites/{$this->properties['site_configuration']['sub_dir']}/settings.php";

    $this->fs->chmod($settings_file_path, 0777);

    /*
     * TODO: merge extra extra.build.<site>.<environment>.yml
     */
    $variables = array_merge($this->getProperties(), []);

    $local_settings = $this->templateRender("settings.{$this->properties['site_configuration']['sub_dir']}.{$this->environment}.html.twig", $variables);

    $task_write = new Write($settings_file_path);
    $task_write->line($local_settings)->append()->run();

    $this->fs->chmod($settings_file_path, 0775);
  }

  /**
   * Import config.
   *
   * Import configurations from folder defined in the configuration file yml.
   */
  public function importConfig() {
    $this->say('Import config');

    if ($this->isSiteInstalled()) {
      $skip_modules = $this->skipModules();

      // This task refer to $config_directories[CONFIG_SYNC_DIRECTORY].
      $this->getDrushWithUri()
        ->exec('cim --skip-modules=' . $skip_modules)
        ->run();
    }
    else {
      $this->printTaskWarning("Import configuration not execute. Drupal not installed.");
    }
  }

  /**
   * Import config partial.
   *
   * Import configurations from folder defined in the configuration file yml.
   * Used drush with option command <em>partial</em>:
   * "Allows for partial config imports from the source directory.
   * Only updates and new configs will be processed with this flag
   * (missing configs will not be deleted)."
   *
   * @see https://drushcommands.com/drush-8x/config/config-import/
   */
  public function importConfigPartial() {
    $this->say('Import config (partial)');

    if ($this->isSiteInstalled()) {
      $skip_modules = $this->skipModules();

      // This task refer to $config_directories[CONFIG_SYNC_DIRECTORY].
      $this->getDrushWithUri()
        ->exec('cim --partial --skip-modules=' . $skip_modules)
        ->run();
    }
    else {
      $this->printTaskWarning("Import configuration not execute. Drupal not installed.");
    }
  }

  /**
   * Export configuration.
   *
   * Export configurations in the folder defined in the configuration file yml.
   */
  public function exportConfig() {
    $this->say('Export config');

    if ($this->isSiteInstalled()) {
      $skip_modules = $this->skipModules();

      // This task refer to $config_directories[CONFIG_SYNC_DIRECTORY].
      $this->getDrushWithUri()
        ->exec('cex --skip-modules=' . $skip_modules)
        ->run();

      /*
       * TODO: retrieve configuration of skip modules and remove.
       */
      $path_config = "{$this->getSiteRoot()}/{$this->properties['site_configuration']['config_dir']}";
      $this->fs->remove($path_config . '/config_devel.settings.yml');
      $this->fs->remove($path_config . '/devel.settings.yml');
      $this->fs->remove($path_config . '/system.menu.devel.yml');
      $this->fs->remove($path_config . '/webprofiler.config.yml');
      $this->fs->remove($path_config . '/field_ui.settings.yml');
    }
    else {
      $this->printTaskWarning("Export configuration not execute. Drupal not installed.");
    }
  }

  /**
   * Backup database.
   *
   * The folder destination is configured in file yml:
   * - backups:
   *   - export_dir: destination backups.
   */
  public function backupDatabase() {

    if (!$this->isSiteInstalled()) {
      $this->printTaskWarning("Backup Database not execute. Site not installed.");
      return;
    }

    $database_name = date("Y") . date("m") . date("d") . '_' . date("H") . date("i") . date("s") . '.sql';
    $folder_backups = "{$this->getBasePath()}/{$this->properties['backups']['export_dir']}";
    $this->getDrushWithUri()
      ->exec("sql-dump --result-file={$folder_backups}/{$this->properties['site_configuration']['uri']}_{$database_name} --ordered-dump")
      ->run();
  }

  /**
   * Import database.
   *
   * The source folder and name of dump are configured in file yml:
   * - backups:
   *   - import_dir: source backups;
   *   - import_dump: name of dump.
   *
   * @param null|string $dump_name
   *   A name of dump.
   */
  public function importDatabase($dump_name = NULL) {
    if (!$this->isSiteInstalled()) {
      $this->printTaskWarning("Import Database not execute. Settings.php not configured.");
      return;
    }

    // Clear exist database.
    $this->getDrushWithUri()
      ->exec("sql-drop")
      ->run();

    $path_backup = "{$this->getBasePath()}/{$this->properties['backups']['import_dir']}";

    if (!isset($dump_name)) {
      $finder = new Finder();
      $finder->files()->name('*.sql')->sortByChangedTime();
      $finder->in($path_backup);
      $iterator = $finder->getIterator();
      $iterator->rewind();
      /** @var SplFileInfo $file */
      $file = $iterator->current();
      $dump_name = $file->getRelativePathname();
    }

    $this->getDrushWithUri()
      ->exec("sql-cli < \"{$path_backup}/{$dump_name}\"")
      ->run();
  }

  /**
   * Update entity.
   */
  public function entityUpdates() {
    $this->say('Entity Update');
    $this->getDrushWithUri()
      ->exec('entity-updates')
      ->run();
  }

  /**
   * Migrate group.
   *
   * @param string $group
   *   Group to migrate.
   */
  public function migrateGroup($group = 'migrate') {

    // Convert array to string.
    if (is_array($group)) {
      $group = implode(' ', $group);
    }

    $this->say("Migration groups: {$group}");
    $this->getDrushWithUri()
      ->exec('migrate-import --group=' . $group)
      ->run();
  }

  /**
   * Migrate status.
   */
  public function migrateStatus() {
    $this->say("Migration status");
    $this->getDrushWithUri()
      ->exec('migrate-status')
      ->run();
  }

  /**
   * Migrate rollback.
   *
   * @param null|string $group
   *   Group to rollback.
   */
  public function migrateRollback($group = NULL) {

    if (!isset($group)) {
      // Convert array to string.
      if (is_array($group)) {
        $group = implode(' ', $group);
      }

      $this->say("Migration groups: {$group}");
      $this->getDrushWithUri()
        ->exec('migrate-rollback --group=' . $group)
        ->run();
    }
    else {
      $this->say("Migration groups: {$group}");
      $this->getDrushWithUri()
        ->exec('migrate-rollback')
        ->run();
    }
  }

  /**
   * Exec command.
   *
   * @param string $command
   *   Command to execute.
   */
  public function exec($command) {
    $this->say('Exec command');
    $this->getDrushWithUri()
      ->exec($command)
      ->run();
  }

  /**
   * Retrieve a DrushStack.
   *
   * @return DrushStack
   *   Retrieve an object DrushStack with the root folder set.
   */
  private function getDrush() {
    $drush_stack = new DrushStack($this->properties['drush_path']);
    return $drush_stack
      ->drupalRootDirectory("{$this->getBasePath()}/{$this->properties['site_configuration']['root']}");
  }

  /**
   * Retrieve a DrushStack with the URI configuration set.
   *
   * @return DrushStack
   *   Retrieve an object DrushStack with the root folder and URI sets.
   */
  private function getDrushWithUri() {
    return $this->getDrush()
      ->uri($this->properties['site_configuration']['uri']);
  }

  /**
   * Get Base Path (path absolute files).
   *
   * @return string
   *   Path absolute files.
   */
  private function getBasePath() {
    return $this->properties['base_path'];
  }

  /**
   * Get Site Path (path absolute files).
   *
   * @return string
   *   Path absolute files of root installation.
   */
  private function getSiteRoot() {
    return "{$this->getBasePath()}/{$this->properties['site_configuration']['site_root']}";
  }

  /**
   * Retrieve if site is installed. Check exist settings.php.
   *
   * TODO: update!I do not like.
   *
   * @return bool
   *   True if site is installed.
   */
  private function isSiteInstalled() {
    $filesystem = new Filesystem();
    return $filesystem->exists("{$this->getSiteRoot()}/sites/{$this->properties['site_configuration']['sub_dir']}/settings.php");
  }

  /**
   * Return a skip modules for export/import configuration.
   *
   * @return string
   *   String of all modules to skipped.
   */
  private function skipModules() {
    $modules = '';
    $array_modules = $this->properties['modules_dev'];
    $modules .= implode(',', $array_modules);
    return $modules;
  }

  /**
   * Renders a template.
   *
   * @param string $template
   *   Template.
   * @param array $variables
   *   Variables.
   *
   * @return string
   *   Template rendered.
   */
  private function templateRender($template, $variables) {
    return $this->twig->render($template, $variables);
  }

}
