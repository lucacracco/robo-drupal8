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
    'project.docroot' => '/web',
    // Git.
    'git.root' => '${project.root}',
    'git.hooks.pre_commit' => '${rd8.root}/scripts/git-hooks',
    'git.hooks.commit_msg' => '${rd8.root}/scripts/git-hooks',
    'git.commit_msg.pattern' => "/(^\${project.prefix}-[0-9]+(: )[^ ].{15,}\\.)|(Merge branch (.)+)/",
    // Composer.
    'composer.bin' => '${project.root}/vendor/bin',
    'composer.extra' => '',
    'composer.dev' => FALSE,
    // RoboDrupal8 Root.
    'rd8.root' => '',
    'rd8.version' => '2.x',
    'rd8.dir' => '${project.root}/rd8',
    // Drush.
    'drush.bin' => '${composer.bin}/drush',
    'drush.dir' => '${project.docroot}',
    'drush.uri' => 'default',
    'drush.sanitaze' => TRUE,
    'drush.alias' => '',
    // Drupal configuration base.
    'drupal.site.machine_name' => 'default',
    'drupal.site.profile' => 'standard',
    'drupal.site.name' => 'Drupal',
    'drupal.site.mail' => 'info@local.local',
    'drupal.site.locale' => 'en',
    'drupal.site.sub_dir' => 'default',
    'drupal.site.base_url' => '',
    'drupal.site.url' => 'http://${drupal.site.machine_name}.${project.machine_name}',
    'drupal.site.directory.config' => '${project.root}/config/${site}/sync',
    'drupal.site.directory.private' => '${project.root}/private/${site}',
    'drupal.site.directory.tmp' => '\tmp',
    'drupal.site.directory.public' => '${project.docroot}/sites/${site}/files',
    // Drupal account administrator.
    'drupal.account.username' => 'admin',
    'drupal.account.mail' => 'admin@local.local',
    'drupal.account.password' => 'admin',
    // Database connection.
    'drupal.databases.default.default.database' => 'databasename',
    'drupal.databases.default.default.username' => 'sqlusername',
    'drupal.databases.default.default.password' => 'sqlpassword',
    'drupal.databases.default.default.host' => 'localhost',
    'drupal.databases.default.default.port' => '3306',
    'drupal.databases.default.default.driver' => 'mysql',
    'drupal.databases.default.default.prefix' => '',
    'drupal.databases.default.default.collation' => 'utf8mb4_general_ci',
    // Database connection replica example.
    //'drupal.databases.default.replica.database' => 'databasename',
    //'drupal.databases.default.replica.username' => 'sqlusername',
    //'drupal.databases.default.replica.password' => 'sqlpassword',
    //'drupal.databases.default.replica.host' => 'localhost',
    //'drupal.databases.default.replica.port' => '3306',
    //'drupal.databases.default.replica.driver' => 'mysql',
    //'drupal.databases.default.replica.prefix' => '',
    //'drupal.databases.default.replica.collation' => 'utf8mb4_general_ci',
    // Database extra example.
    //'drupal.databases.extra.default.database' => 'databasename',
    //'drupal.databases.extra.default.username' => 'sqlusername',
    //'drupal.databases.extra.default.password' => 'sqlpassword',
    //'drupal.databases.extra.default.host' => 'localhost',
    //'drupal.databases.extra.default.port' => '3306',
    //'drupal.databases.extra.default.driver' => 'mysql',
    //'drupal.databases.extra.default.prefix' => '',
    //'drupal.databases.extra.default.collation' => 'utf8mb4_general_ci',
    'drupal.databases.backup_dir' => '${project.root}/export-database/${drupal.site.machine_name}',
    // Templates for settings files.
    'drupal.template_files.dir' => NULL,
    'drupal.template_files.settings' => '${project.docroot}/sites/${site}/default.settings.php.twig',
    'drupal.template_files.services' => '${project.docroot}/sites/${site}/default.services.yml.twig',
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
    $this->set('project.docroot', $drupalFinder->getDrupalRoot());
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
    if (!$this->get('drush.uri') && $site != 'default') {
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
    $sites_dir = $this->get('project.docroot') . '/sites';
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
      $this->setDefault($key, $value);
    }
  }

}
