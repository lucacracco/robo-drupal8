<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

use Lucacracco\Drupal8\Robo\Utility\Configurations;
use Lucacracco\Drupal8\Robo\Utility\PathResolver;

/**
 * Robo task base: Settings site.
 */
class Settings extends SiteTask {

  /**
   * Return tasks collection for configure settings.php.
   *
   * @return $this
   */
  public function updateSettings() {

    $path_settings = PathResolver::siteDirectory() . '/settings.php';
    $databases = Configurations::get('databases');
    $conf = Configurations::configurations();
    $settings = [];

    foreach ($databases as $database_key => $database_info) {
      foreach ($this->convertDatabaseFromDatabaseUrl($database_info) as $key => $value) {
        $settings['databases.' . $database_key . '.' . $key] = $value;
      }
      // Insert manual the info of 'prefix' and 'namespace' because is not found in url.
      $settings['databases.' . $database_key . '.prefix'] = $database_info['prefix'];
      $settings['databases.' . $database_key . '.namespace'] = $database_info['namespace'];
    }

    // Save configurations new.
    foreach ($settings as $key => $value) {
      $conf->set($key, $value);
    }

    $template_name = $conf->get('site_configuration.tpl_settings');
    $twig_loader = new \Twig_Loader_Filesystem(PathResolver::templatesFolder());
    $twig = new \Twig_Environment($twig_loader);
    $settings_rendered = $twig->render($template_name, $conf->all());

    $task_list = [
      'Settings.chmod' => $this->collectionBuilder()
        ->taskFilesystemStack()
        ->chmod($path_settings, 0777),
      'Settings.write' => $this->collectionBuilder()
        ->taskWriteToFile($path_settings)
        ->line($settings_rendered)
        ->append(),
      // TODO: chmod settings.php with ?? (0600)
    ];

    $this->collection->addTaskList($task_list);

    return $this;
  }

  /**
   * Convert from an old-style database URL to an array of database settings.
   *
   * @param db_url
   *   A Drupal 6 db url string to convert, or an array with a 'default' element.
   * @return array
   *   An array of database values containing only the 'default' element of
   *   the db url. If the parse fails the array is empty.
   */
  private function convertDatabaseFromDatabaseUrl($database_info) {
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

}
