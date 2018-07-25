<?php

namespace Lucacracco\RoboDrupal8\Robo\Config;

use DrupalFinder\DrupalFinder;
use Symfony\Component\Finder\Finder;

/**
 * Default configuration for Robo-Drupal8.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Config
 */
class DefaultConfig extends RoboDrupal8Config {

  /**
   * Default configurations for RoboDrupal8.
   *
   * @var array
   */
  protected $rd8_default_values = [
    // Project
    'project.root' => '.',
    'project.machine_name' => 'rd8',
    'project.prefix' => 'RD8',
    'project.human_name' => 'RoboDrupal 8 Example Project',
    // Git.
    'git.root' => '${project.root}',
    'git.hooks.pre_commit' => '${rd8.root}/scripts/git-hooks',
    'git.hooks.commit_msg' => '${rd8.root}/scripts/git-hooks',
    'git.commit_msg.pattern' => "/(^\${project.prefix}-[0-9]+(: )[^ ].{15,}\\.)|(Merge branch (.)+)/",
    // Composer.
    'composer.bin' => '${project.root}/vendor/bin',
    'composer.extra' => '',
    // Web root.
    'docroot' => '/web',
    // RoboDrupal8 Root.
    'rd8.root' => '',
    'rd8.version' => '2.x',
    // Drush.
    'drush.bin' => '${composer.bin}/drush',
    'drush.dir' => '${docroot}',
    'drush.uri' => 'default',
    'drush.sanitaze' => TRUE,
    'drush.alias' => '',
    // Drupal configuration base.
    'drupal.site.machine_name' => 'default',
    'drupal.site.profile' => 'standard',
    'drupal.site.name' => 'Drupal',
    'drupal.site.mail' => 'info@local.local',
    'drupal.account.username' => 'admin',
    'drupal.account.mail' => 'admin@local.local',
    'drupal.account.password' => 'admin',
    'drupal.locale' => 'en',
    'drupal.settings_file' => '${docroot}/sites/${site}/default.settings.php',
    'drupal.services_file' => '${docroot}/sites/${site}/default.services.yml',
    'drupal.local_settings_file' => '',
    'drupal.url' => 'http://${drupal.site.machine_name}.${project.machine_name}',
    //    'drupal.root' => 'web',
    'drupal.config_directories.sync' => '${project.root}/config/${drupal.site.machine_name}/sync',
    // Database connection.
    'drupal.databases.default.default.database' => 'databasename',
    'drupal.databases.default.default.username' => 'sqlusername',
    'drupal.databases.default.default.password' => 'sqlpassword',
    'drupal.databases.default.default.host' => 'localhost',
    'drupal.databases.default.default.port' => '3306',
    'drupal.databases.default.default.driver' => 'mysql',
    'drupal.databases.default.default.prefix' => '',
    'drupal.databases.default.default.collation' => 'utf8mb4_general_ci',
    'drupal.database.dir_export' => '${project.root}/export-database/${drupal.site.machine_name}',
    // PHPCs.
    'phpcs.bin' => '',
    'phpcs.standard' => 'Drupal,DrupalPractice',
    // PHPUnit.
    'phpunit.bin' => '',
  ];

  /**
   * DefaultConfig constructor.
   *
   * @param string $project_root
   *   The repository root of the project that depends on RD8.
   *
   * @throws \Exception
   */
  public function __construct($project_root) {
    parent::__construct();

    $this->initDefaultConfigs();

    $drupalFinder = new DrupalFinder();
    $drupalFinder->locateRoot($project_root);
    $this->set('project.root', $project_root);
    $this->set('docroot', $drupalFinder->getDrupalRoot());
    $this->set('rd8.root', $drupalFinder->getVendorDir() . "/lucacracco/robo-drupal8");
    $this->set('composer.bin', $drupalFinder->getVendorDir() . '/bin');
  }

  /**
   * Populates configuration settings not available during construction.
   */
  public function populateHelperConfig() {
    $defaultAlias = $this->get('drush.default_alias');
    $alias = $defaultAlias == 'self' ? '' : $defaultAlias;
    $this->set('drush.alias', $alias);
    $site_dirs = $this->getSiteDirs();
    $first_site = reset($site_dirs);
    $site = $this->get('site', $first_site);
    $this->setSite($site);
  }

  /**
   * @param $site
   */
  public function setSite($site) {
    $this->set('site', $site);
    if (!$this->get('drush.uri')) {
      $this->set('drush.uri', $site);
    }
  }

  /**
   * Gets an array of sites for the Drupal application.
   *
   * I.e., sites under docroot/sites, not including acsf 'g' pseudo-site.
   *
   * @return array
   *   An array of sites.
   */
  protected function getSiteDirs() {
    $sites_dir = $this->get('docroot') . '/sites';
    $sites = [];

    if (!file_exists($sites_dir)) {
      return $sites;
    }

    $finder = new Finder();
    $dirs = $finder
      ->in($sites_dir)
      ->directories()
      ->depth('< 1')
      ->exclude(['g']);
    foreach ($dirs->getIterator() as $dir) {
      $sites[] = $dir->getRelativePathname();
    }

    return $sites;
  }

  /**
   * Init configurations.
   */
  protected function initDefaultConfigs() {
    foreach ($this->rd8_default_values as $key => $value) {
      $this->set($key, $value);
    }
  }

}
