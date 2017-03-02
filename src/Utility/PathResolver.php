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
   * @return string The path to local
   */
  public static function getBasePath() {
    return Configurations::get('base_path', self::$localPath);
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
    $config_dir = Configurations::get('site_configuration.config_dir');
    if (!isset($config_dir)) {
      // TODO: load from status/report site.
      throw new \Exception("Not found config_sync dir in configuration file.");
    }
    return static::root() . '/' . $config_dir;
  }

  /**
   * Return database dump path.
   *
   * TODO: remove this functions, not used (but first check everywhere!).
   *
   * @return string
   *   The path to the database dump file.
   *
   * @deprecated
   */
  public static function databaseDump($name = NULL) {
    // TODO: database name!
    return static::root() . '/database/project.sql';
  }

  /**
   * Return docroot path.
   *
   * @return string
   *   The path to the Drupal docroot.
   */
  public static function docroot() {
    $default = static::root() . '/web';
    return Configurations::get('drupal_root_directory', $default);
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
    return Configurations::get('drush_path' , $default);
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
    $templates_folder = Configurations::get('templates_folder');
    if (isset($templates_folder) &&
      static::existDir($templates_folder)
    ) {
      return $templates_folder;
    }
    else {
      throw new \Exception("Not found 'templates_folder' dir in configurations file.");
    }
  }

  /**
   * Initialize path resolver.
   *
   * @param string $root
   *   The root path to use.
   */
  public static function init($root) {
    static::rootCache($root);
  }

  /**
   * Return root path.
   *
   * @return string
   *   The path to the project root.
   */
  public static function root() {
    return static::rootCache();
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
    $sub_dir = Configurations::get('site_configuration.sub_dir', 'default');
    if (static::existDir($sub_dir)) {
      throw new \Exception("Site Directory not found.");
    }
    return static::docroot() . '/sites/' . $sub_dir;
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
      $path = realpath(static::docroot() . '/' . $path) ?: static::docroot() . '/' . $path;
    }

    return $path;
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
   * Cache root path in global variable.
   *
   * @param null|string $root
   *   The root path to cache.
   *
   * @return string
   *   The cached root path.
   *
   * @throws \Exception
   */
  protected static function rootCache($root = NULL) {
    $cid = '__ROOT__';

    if (isset($root) && !empty($root)) {
      if (isset($GLOBALS[$cid]) && !empty($GLOBALS[$cid])) {
        throw new \Exception(__CLASS__ . ' - Is already initialized.');
      }

      $GLOBALS[$cid] = $root;
    }

    if (!isset($GLOBALS[$cid]) || empty($GLOBALS[$cid])) {
      throw new \Exception(__CLASS__ . ' - Not initialized.');
    }

    return $GLOBALS[$cid];
  }

}
