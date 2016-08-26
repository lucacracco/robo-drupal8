<?php

namespace LucaCracco\Robo\Task\Drupal8;

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
abstract class Drupal8RoboFile extends \Robo\Tasks {

  use \LucaCracco\Robo\Task\Drupal8\loadTasks;

  const ENV_LOCAL = 'local';
  const ENV_STAGE = 'stage';
  const ENV_PROD = 'prod';

  const OPTS = [
    'site|s' => 'default',
    'environment|e' => self::ENV_LOCAL,
  ];

  /**
   * Path where to find the configuration files.
   *
   * @var string
   */
  protected $pathProperties = 'build';

  /**
   * Sub Dirs.
   *
   * Match to the sites that you want to start, useful for multi-site.
   * In the case of a single installation to use/leave 'default'.
   *
   * @var array
   */
  protected $subDir = ['default', 'example'];

  /**
   * Build a site from scratch.
   *
   * @param array $opts Options.
   *   Options.
   *
   * @option $environment|e Environment
   * @option $site|s Site
   */
  public function buildNew($opts = self::OPTS) {

    $parameter = $this->getInfoSite($opts['site'], $opts['environment']);
    $drupal8_stack = $this->taskDrupal8Stack($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
      ->backupDatabase()
      ->setupInstallation()
      ->install()
      ->configureSettings()
      ->protectSite()
      ->coreCron()
      ->entityUpdates()
      ->rebuildCache()
      ->installModules();

    if ($parameter['environment'] == 'local') {
      $drupal8_stack->installModules('dev');
    }

    $drupal8_stack
      ->getInfoSite()
      ->run();

    return $drupal8_stack;
  }

  /**
   * Build a site from configuration files.
   *
   * @param array $opts Options.
   *   Options.
   *
   * @option $environment|e Environment
   * @option $site|s Site
   */
  public function buildConf($opts = self::OPTS) {

    $parameter = $this->getInfoSite($opts['site'], $opts['environment']);
    $drupal8_stack = $this->taskDrupal8Stack($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
      ->backupDatabase()
      ->setupInstallation()
      ->installFromConfig()
      ->configureSettings()
      ->protectSite()
      ->coreCron()
      ->entityUpdates()
      ->rebuildCache();

    if ($parameter['environment'] == 'local') {
      $drupal8_stack->installModules('dev');
    }

    $drupal8_stack
      ->getInfoSite()
      ->run();

    return $drupal8_stack;
  }

  /**
   * Build an existing site by importing the database.
   *
   * @param array $opts Options.
   *   Options.
   *
   * @option $environment|e Environment
   * @option $site|s Site
   */
  public function buildFromDatabase($opts = self::OPTS) {

    $parameter = $this->getInfoSite($opts['site'], $opts['environment']);
    $drupal8_stack = $this->taskDrupal8Stack($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
      ->backupDatabase()
      ->configureSettings()
      ->importDatabase()
      ->protectSite()
      ->coreCron()
      ->rebuildCache();

    if ($parameter['environment'] == 'local') {
      $drupal8_stack->installModules('dev');
    }

    $drupal8_stack
      ->getInfoSite()
      ->run();

    return $drupal8_stack;
  }

  /**
   * Export configuration after clear cache.
   *
   * @param array $opts Options.
   *   Options.
   *
   * @option $environment|e Environment
   * @option $site|s Site
   */
  public function configurationExport($opts = self::OPTS) {
    $parameter = $this->getInfoSite($opts['site'], $opts['environment']);
    $this->taskDrupal8Stack($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
      ->rebuildCache()
      ->exportConfig()
      ->run();
  }


  /**
   * Import configuration.
   *
   * @param array $opts Options.
   *   Options.
   *
   * @option $environment|e Environment
   * @option $site|s Site
   */
  public function configurationImport($opts = self::OPTS) {
    $parameter = $this->getInfoSite($opts['site'], $opts['environment']);
    $this->taskDrupal8Stack($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
      ->rebuildCache()
      ->exportConfig()
      ->rebuildCache()
      ->run();
  }

  /**
   * Run migrate.
   *
   * @param array $opts Options.
   *   Options.
   *
   * @option $environment|e Environment
   * @option $site|s Site
   * @option $group|g Group of migration
   */
  public function migrateRun($opts = self::OPTS + ['group|g' => 'migrate']) {
    $parameter = $this->getInfoSite($opts['site'], $opts['environment']);

    $this->taskDrupal8Stack($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
      ->rebuildCache()
      ->migrateGroup($opts['group'])
      ->run();
  }

  /**
   * Run status of migrate.
   *
   * @param array $opts Options.
   *   Options.
   *
   * @option $environment|e Environment
   * @option $site|s Site
   * @option $group|g Group of migration
   */
  public function migrateStatus($opts = self::OPTS) {
    $parameter = $this->getInfoSite($opts['site'], $opts['environment']);

    $this->taskDrupal8Stack($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
      ->rebuildCache()
      ->migrateStatus()
      ->run();
  }

  /**
   * Run rollback.
   *
   * @param array $opts Options.
   *   Options.
   *
   * @option $environment|e Environment
   * @option $site|s Site
   * @option $group|g Group of migration
   */
  public function migrateRollback($opts = self::OPTS + ['group|g' => NULL]) {
    $parameter = $this->getInfoSite($opts['site'], $opts['environment']);

    $this->taskDrupal8Stack($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
      ->rebuildCache()
      ->migrateRollback($opts['group'])
      ->run();
  }


  /**
   * Configure PhpUnit.
   *
   * @param array $opts Options.
   *   Options.
   *
   * @option $environment|e Environment
   * @option $site|s Site
   */
  public function phpunitConfigure($opts = self::OPTS) {
    $parameter = $this->getInfoSite($opts['site'], $opts['environment']);

    $this->say('Configure PHPUnit');

    /* TODO: configure phpunit.xml with properties */

  }

  /**
   * Run PhpUnit.
   *
   * @param array $opts Options.
   *   Options.
   *
   * @option $environment|e Environment
   * @option $site|s Site
   */
  public function phpunitRun($opts = self::OPTS) {
    $parameter = $this->getInfoSite($opts['site'], $opts['environment']);

    $this->say('Start PHPUnit');

    /* TODO: start tests */

  }

  /**
   * Get status of site.
   *
   * @param array $opts Options.
   *   Options.
   *
   * @option $environment|e Environment
   * @option $site|s Site
   */
  public function statusSite($opts = self::OPTS) {
    $parameter = $this->getInfoSite($opts['site'], $opts['environment']);
    $this->taskDrupal8Functionality($parameter['environment'], $parameter['sub_dir'], $parameter['path_properties'])
      ->getInfoSite();
  }

  /**
   * Get data of build project in local environment.
   *
   * @param null|string $site
   *   Name of site.
   * @param string $environment
   *   Environment.
   *
   * @return array
   *   Array contains a single site or all site.
   */
  protected function getInfoSite($site = NULL, $environment = 'local') {
    if (in_array($site, $this->subDir)) {
      return [
        'environment' => $environment,
        'sub_dir' => $site,
        'path_properties' => $this->pathProperties,
      ];
    }

    $sites_data = [];
    foreach ($this->subDir as $site) {
      $sites_data[$site] = [
        'environment' => $environment,
        'sub_dir' => $site,
        'path_properties' => $this->pathProperties,
      ];
    }
    return $sites_data;
  }

}
