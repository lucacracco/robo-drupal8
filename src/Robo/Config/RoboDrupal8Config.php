<?php

namespace Lucacracco\RoboDrupal8\Robo\Config;

use Grasmash\YamlExpander\Expander;
use Robo\Config\Config;

/**
 * Class RoboDrupal8Config.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Config
 */
class RoboDrupal8Config extends Config {

  /**
   * Default configurations for RoboDrupal8.
   *
   * @var array
   */
  protected $default = [
    // Project
    'project.root' => '.',
    'project.machine_name' => 'rd8',
    'project.prefix' => 'RD8',
    'project.human_name' => 'RoboDrupal 8 Example Project',
    // Git.
    'git.hooks.pre-commit' => '${rd8.root}/scripts/git-hooks',
    'git.hooks.commit-msg' => '${rd8.root}/scripts/git-hooks',
    'git.commit-msg.pattern' => "/(^\${project.prefix}-[0-9]+(: )[^ ].{15,}\\.)|(Merge branch (.)+)/",
    // Composer.
    'composer.bin' => '${project.root}/vendor/bin',
    'composer.extra' => '',
    // Web root.
    'docroot' => '/docroot',
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
    'drupal.local_settings_file' => '',
    'drupal.settings_file' => '',
    'drupal.url' => 'http://${drupal.site.machine_name}.${project.machine_name}',
    'drupal.root' => 'web',
    'drupal.config_directories.sync' => '${project.root}/config/${drupal.site.machine_name}/sync',
    // Database connection.
    'database.name' => '',
    'database.host' => '',
    'database.port' => '3306',
    'database.username' => '',
    'database.password' => '',
    // PHPCs.
    'phpcs.bin' => '',
    'phpcs.standard' => 'Drupal,DrupalPractice',
    // PHPUnit.
    'phpunit.bin' => '',
  ];

  /**
   * RoboDrupal8Config constructor.
   *
   * @param array|NULL $data
   */
  public function __construct(array $data = NULL) {
    parent::__construct($data);
    $this->init();
  }

  /**
   * Init configurations.
   */
  protected function init() {
    foreach ($this->default as $key => $value) {
      $this->set($key, $value);
    }
  }

  /**
   * Expands YAML placeholders in a given file, using config object.
   *
   * @param string $filename
   *   The file in which placeholders should be expanded.
   */
  public function expandFileProperties($filename) {
    $expanded_contents = Expander::expandArrayProperties(file($filename), $this->export());
    file_put_contents($filename, implode("", $expanded_contents));
  }

  /**
   * Set a config value.
   *
   * @param string $key
   *   The config key.
   * @param mixed $value
   *   The config value.
   *
   * @return $this
   */
  public function set($key, $value) {
    if ($value === 'false') {
      $value = FALSE;
    }
    elseif ($value === 'true') {
      $value = TRUE;
    }

    // Expand properties in string. We do this here so that one can pass
    // -D drush.alias=${drush.ci.aliases} at runtime and still expand
    // properties.
    if (is_string($value) && strstr($value, '$')) {
      $expanded = Expander::expandArrayProperties([$value], $this->export());
      $value = $expanded[0];
    }

    return parent::set($key, $value);
  }

  /**
   * Fetch a configuration value.
   *
   * @param string $key
   *   Which config item to look up.
   * @param string|null $defaultOverride
   *   Override usual default value with a different default. Deprecated;
   *   provide defaults to the config processor instead.
   *
   * @return mixed
   */
  public function get($key, $defaultOverride = NULL) {
    $value = parent::get($key, $defaultOverride);

    // Last ditch effort to expand properties that may not have been processed.
    if (is_string($value) && strstr($value, '$')) {
      $expanded = Expander::expandArrayProperties([$value], $this->export());
      $value = $expanded[0];
    }

    return $value;
  }

}
