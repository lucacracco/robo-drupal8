<?php

namespace Lucacracco\Drupal8\Robo\Utility;

use Symfony\Component\Filesystem\Filesystem;

/**
 * A helper class for path resolving.
 */
class PathResolver {

  /**
   * The path to the local (Defaults to linux path).
   *
   * @var string
   */
  protected static $localPath = '/var/www/html';

  /**
   * Return absolute path.
   *
   * This makes relative paths absolute using the docroot path as base.
   *
   * @param $path
   *   The path to make absolute.
   *
   * @return string
   *   The absolute path.
   */
  public static function absolute($path) {
    $fs = new Filesystem();

    // Make path absolute (if not already).
    if (!$fs->isAbsolutePath($path)) {
      $path = realpath($path);
    }

    return $path;
  }

  /**
   * Return path exported configuration.
   *
   * @return string
   *   The path to the exported Drupal configuration files.
   *
   * @throws \Exception
   *   If not found configurations 'config_sync' dir in configuration file.
   */
  public static function config() {
    $config_dir = \Robo\Robo::config()->get('drupal.site.config_dir');
    if (!isset($config_dir)) {
      // TODO: load from status/report site.
      throw new \Exception("Not found config_sync dir in configuration file.");
    }
    return static::root() . '/' . $config_dir;
  }

  /**
   * Return docroot path.
   *
   * @return string
   *   The path to the Drupal docroot.
   */
  public static function docroot() {
    $default = static::root() . '/web';
    return self::absolute(\Robo\Robo::config()->get('drupal.root', $default));
  }

  /**
   * Return Drush binary path.
   *
   * Use custom thought configuration file: drush_path (absolute path).
   *
   * @return string
   *   The path to the Drush binary.
   */
  public static function drush() {
    $default = static::root() . '/vendor/bin/drush';
    return self::absolute(\Robo\Robo::config()
      ->get('project.drush_path', $default));
  }

  /**
   * Return if directory/files exist or not.
   *
   * @param $path
   *   The path to check.
   *
   * @return boolean
   */
  public static function existDir($path) {
    $fs = new Filesystem();
    return $fs->exists($path);
  }

  /**
   * @return string The path to local
   */
  public static function getBasePath() {
    return \Robo\Robo::config()->get('project.base_path', self::$localPath);
  }

  /**
   * Initialize path resolver.
   *
   * @param string $root
   *   The root path to use.
   */
  public static function init($root) {
    $base_path = self::absolute($root);
    \Robo\Robo::config()->set('project.base_path', $base_path);
  }

  /**
   * Return root path.
   *
   * @return string
   *   The path to the project root.
   */
  public static function root() {
    return self::absolute(\Robo\Robo::config()->get('project.base_path'));
  }

  /**
   * Return site directory path.
   *
   * @return string
   *   The path to the site directory of Drupal.
   *
   * @throws \Exception
   */
  public static function siteDirectory() {
    // Read from configuration.
    $sub_dir = \Robo\Robo::config()->get('drupal.site.sub_dir', 'default');
    if (static::existDir($sub_dir)) {
      throw new \Exception("Site Directory not found.");
    }
    return static::docroot() . '/sites/' . $sub_dir;
  }

  /**
   * Return database dump path.
   *
   * @return string
   *   The suggestions path.
   */
  public static function suggestionPathDump() {
    $dir = \Robo\Robo::config()->get('project.backups_dir', './');
    $environment = Environment::getEnvironment();
    $uri = \Robo\Robo::config()->get('drupal.site.uri', 'default');
    $date = date('Ymd_His');
    $dump_name = "{$uri}.{$environment}.{$date}.sql";
    $path = $dir . DIRECTORY_SEPARATOR . $dump_name;
    return $path;
  }

  /**
   * Return a path for templates twig.
   *
   * TODO: check if a directory.
   *
   * @return string
   *   The path to the directory.
   *
   * @throws \Exception
   *   If not found configuration 'templates_folder' in configurations file.
   */
  public static function templatesFolder() {
    // Read from configuration.
    $templates_folder = \Robo\Robo::config()->get('project.templates_dir');
    if (isset($templates_folder) &&
      static::existDir($templates_folder)
    ) {
      return $templates_folder;
    }
    else {
      throw new \Exception("Not found 'project.templates_dir' dir in configurations file.");
    }
  }

}
