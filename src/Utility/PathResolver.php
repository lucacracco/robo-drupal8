<?php

namespace Lucacracco\Drupal8\Robo\Utility;

use Symfony\Component\Filesystem\Filesystem;

/**
 * A helper class for path resolving.
 *
 * Configuration for paths loaded from Application (\Robo\Robo::config()).
 */
class PathResolver {

  /**
   * @var \Robo\Config\Config
   */
  protected static $conf;

  /**
   * @return \Robo\Config\Config
   */
  public static function getConf() {
    if (!isset(self::$conf)) {
      self::$conf = \Robo\Robo::config();
    }
    return self::$conf;
  }

  /**
   * @param \Robo\Config\Config $conf
   */
  public static function setConf($conf) {
    self::$conf = $conf;
  }

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
   * Return docroot path. Es. web.
   *
   * @return string
   *   The path to the Drupal docroot.
   */
  public static function docroot() {
    $default = static::getProjectPath() . DIRECTORY_SEPARATOR . 'web';
    return self::absolute(self::getConf()->get('drupal.root', $default));
  }

  /**
   * Return Drush binary path.
   *
   * Use custom thought configuration file: drush_path (absolute path).
   *
   * @return string
   *   The path to the Drush binary.
   */
  public static function drushPath() {
    $default = static::getProjectPath() . '/vendor/bin/drushPath';
    return self::absolute(self::getConf()->get('project.drush_path', $default));
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
   * Return a path of project.
   *
   * @return string The path to local
   */
  public static function getProjectPath() {
    return self::getConf()->get('project.path', '/var/www/html');
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
    $sub_dir = self::getConf()->get('drupal.site.sub_dir', 'default');
    if (static::existDir($sub_dir)) {
      throw new \Exception("Site Directory not found.");
    }
    return static::docroot() . DIRECTORY_SEPARATOR . 'sites' . DIRECTORY_SEPARATOR . $sub_dir;
  }

  /**
   * Return database dump path.
   *
   * @return string
   *   The suggestions path.
   */
  public static function suggestionPathDump() {
    $dir = self::getConf()->get('project.backups_dir', './');
    $environment = Environment::getEnvironment();
    $uri = self::getConf()->get('drupal.site.uri', 'default');
    $date = date('Ymd_His');
    $dump_name = "{$uri}.{$environment}.{$date}.sql";
    $path = $dir . DIRECTORY_SEPARATOR . $dump_name;
    return $path;
  }

}
