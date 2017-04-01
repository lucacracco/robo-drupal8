<?php

namespace Lucacracco\Drupal8\Robo\Utility;

use Lucacracco\Drupal8\Robo\Common\GlobalsCache;
use Symfony\Component\Filesystem\Filesystem;

/**
 * A helper class for path resolving.
 */
class PathResolver {

  use GlobalsCache;

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
    return Configurations::get('project.base_path', self::$localPath);
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
    $config_dir = Configurations::get('drupal.site.config_dir');
    if (!isset($config_dir)) {
      // TODO: load from status/report site.
      throw new \Exception("Not found config_sync dir in configuration file.");
    }
    return static::root() . '/' . $config_dir;
  }

  /**
   * Return database dump path.
   *
   * @return string
   *   The suggestions path.
   */
  public static function suggestionPathDump() {
    // TODO: create if not exist?!
    $folder = Configurations::get('project.backups_dir', '.');
    $name = $database_name = date("Y") . date("m") . date("d") . '_' . date("H") . date("i") . date("s") . '.sql';
    $surname = Environment::getEnvironment();
    return $folder . DIRECTORY_SEPARATOR . $surname . '_' . $name;
  }

  /**
   * Return docroot path.
   *
   * @return string
   *   The path to the Drupal docroot.
   */
  public static function docroot() {
    $default = static::root() . '/web';
    return Configurations::get('drupal.root', $default);
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
    return Configurations::get('project.drush_path', $default);
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
    $templates_folder = Configurations::get('project.templates_dir');
    if (isset($templates_folder) &&
      static::existDir($templates_folder)
    ) {
      return $templates_folder;
    }
    else {
      throw new \Exception("Not found 'project.templates_dir' dir in configurations file.");
    }
  }

  /**
   * Initialize path resolver.
   *
   * @param string $root
   *   The root path to use.
   */
  public static function init($root) {
    static::globalCacheVariable('__ROOT__', $root);
  }

  /**
   * Return root path.
   *
   * @return string
   *   The path to the project root.
   */
  public static function root() {
    return static::globalCacheVariable('__ROOT__');
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
    $sub_dir = Configurations::get('drupal.site.sub_dir', 'default');
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

}
