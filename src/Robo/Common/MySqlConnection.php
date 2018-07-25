<?php

namespace Lucacracco\RoboDrupal8\Robo\Common;

/**
 * Utility for convert or managed configuration mysql.
 *
 * @package Lucacracco\Robo\Common
 */
class MySqlConnection {

  /**
   * Convert from an old-style database URL to an array of database settings.
   *
   * @param $database_info
   *   A Drupal 6 db url string to convert, or an array with a 'default'
   *   element.
   *
   * @return array
   *   An array of database values containing only the 'default' element of
   *   the db url. If the parse fails the array is empty.
   */
  public static function convertDatabaseFromDatabaseUrl($database_info) {
    $db_url = $database_info['url'];
    $db_spec = [];

    if (is_array($db_url)) {
      $db_url_default = $db_url['default'];
    }
    else {
      $db_url_default = $db_url;
    }

    // If it's a sqlite database, pick the database path and we're done.
    if (strpos($db_url_default, 'sqlite://') === 0) {
      $db_spec = [
        'driver' => 'sqlite',
        'database' => substr($db_url_default, strlen('sqlite://')),
      ];
    }
    else {
      $url = parse_url($db_url_default);
      if ($url) {
        // Fill in defaults to prevent notices.
        $url += [
          'scheme' => NULL,
          'user' => NULL,
          'pass' => NULL,
          'host' => NULL,
          'port' => NULL,
          'path' => NULL,
          'prefix' => '',
          'namespace' => '',
        ];
        $url = (object) array_map('urldecode', $url);
        $db_spec = [
          'driver' => $url->scheme == 'mysqli' ? 'mysql' : $url->scheme,
          'username' => $url->user,
          'password' => $url->pass,
          'host' => $url->host,
          'port' => $url->port,
          'database' => ltrim($url->path, '/'),
          'prefix' => $url->prefix,
          'namespace' => $url->namespace,
        ];
      }
    }

    return $db_spec;
  }

  /**
   * Convert database from database array.
   *
   * @param array $database_info
   *
   * @return string
   */
  public static function convertDatabaseFromDatabaseArray($database_info) {
    return $database_info['driver'] . '://' . $database_info['username'] . ':' . $database_info['password'] . '@' . $database_info['host'] . ':' . $database_info['port'] . '/' . $database_info['database'];
  }

}
