<?php

/**
 * @file
 * Setup RD8 utility variables, include required files.
 */

use Drupal\Core\DrupalKernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Host detection.
 */
if (!empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
  $forwarded_host = $_SERVER['HTTP_X_FORWARDED_HOST'];
}
elseif (!empty($_SERVER['HTTP_HOST'])) {
  $forwarded_host = $_SERVER['HTTP_HOST'];
}
else {
  $forwarded_host = NULL;
}

$server_protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
$forwarded_protocol = !empty($_ENV['HTTP_X_FORWARDED_PROTO']) ? $_ENV['HTTP_X_FORWARDED_PROTO'] : $server_protocol;

/*******************************************************************************
 * Environment detection.
 ******************************************************************************/

/**
 * Envs.
 */
$repo_root = dirname(DRUPAL_ROOT);

/**
 * Production envs.
 */
$is_production_env = isset($_ENV['PRODUCTION_ENVIRONMENT']);

/**
 * Test envs.
 */
$is_test_env = isset($_ENV['TEST_ENVIRONMENT']);

/**
 * Dev envs.
 */
$is_dev_env = isset($_ENV['DEV_ENVIRONMENT']);

/**
 * Local envs.
 */
$is_local_env = !$is_dev_env && !$is_test_env && !$is_production_env;

/**
 * Site directory detection.
 */
if (!isset($site_path)) {
  try {
    $site_path = DrupalKernel::findSitePath(Request::createFromGlobals());
  }
  catch (BadRequestHttpException $e) {
    $site_path = 'sites/default';
  }
}
$site_dir = str_replace('sites/', '', $site_path);

/*******************************************************************************
 * RD8 includes & RD8 default configuration.
 ******************************************************************************/

// Includes caching configuration.
require __DIR__ . '/cache.settings.php';

// Includes configuration management settings.
require __DIR__ . '/config.settings.php';

// Includes logging configuration.
require __DIR__ . '/logging.settings.php';

// Includes filesystem configuration.
require __DIR__ . '/filesystem.settings.php';

/**
 * Salt for one-time login links, cancel links, form tokens, etc.
 *
 * This variable will be set to a random value by the installer. All one-time
 * login links will be invalidated if the value is changed. Note that if your
 * site is deployed on a cluster of web servers, you must ensure that this
 * variable has the same value on each server.
 *
 * For enhanced security, you may set this variable to the contents of a file
 * outside your document root; you should also ensure that this file is not
 * stored with backups of your database.
 *
 * Example:
 *
 * @code
 *   $settings['hash_salt'] = file_get_contents('/home/example/salt.txt');
 * @endcode
 */
$settings['hash_salt'] = file_get_contents(DRUPAL_ROOT . '/../salt.txt');

/**
 * Deployment identifier.
 *
 * Drupal's dependency injection container will be automatically invalidated and
 * rebuilt when the Drupal core version changes. When updating contributed or
 * custom code that changes the container, changing this identifier will also
 * allow the container to be invalidated as soon as code is deployed.
 */
$settings['deployment_identifier'] = \Drupal::VERSION;
$deploy_id_file = DRUPAL_ROOT . '/../deployment_identifier';
if (file_exists($deploy_id_file)) {
  $settings['deployment_identifier'] = file_get_contents($deploy_id_file);
}

/**
 * Include custom global settings files.
 *
 * This is intended for to provide an opportunity for applications to override
 * any previous configuration at a global or multisite level.
 *
 * This is being included before the CI and site specific files so all available
 * settings are able to be overridden in the includes.settings.php file below.
 */
if ($settings_files = glob(DRUPAL_ROOT . "/sites/settings/*.settings.php")) {
  foreach ($settings_files as $settings_file) {
    require $settings_file;
  }
}

/*******************************************************************************
 * Environment-specific includes.
 ******************************************************************************/

/**
 * Include optional site specific includes file.
 *
 * This is intended for to provide an opportunity for applications to override
 * any previous configuration.
 *
 * This is being included before the local file so all available settings are
 * able to be overridden in the local.settings.php file below.
 */
if (file_exists(DRUPAL_ROOT . "/sites/$site_dir/settings/includes.settings.php")) {
  require DRUPAL_ROOT . "/sites/$site_dir/settings/includes.settings.php";
}

/**
 * Load local development override configuration, if available.
 *
 * This is intended to provide an opportunity for local environments to override
 * any previous configuration.
 *
 * Use local.settings.php to override variables on secondary (staging,
 * development, etc) installations of this site. Typically used to disable
 * caching, JavaScript/CSS compression, re-routing of outgoing emails, and
 * other things that should not happen on development and testing sites.
 *
 * Keep this code block at the end of this file to take full effect.
 */
if ($is_local_env) {
  // Load local settings for all sites.
  if (file_exists(DRUPAL_ROOT . "/sites/settings/local.settings.php")) {
    require DRUPAL_ROOT . "/sites/settings/local.settings.php";
  }
  // Load local settings for given single.
  if (file_exists(DRUPAL_ROOT . "/sites/$site_dir/settings/local.settings.php")) {
    require DRUPAL_ROOT . "/sites/$site_dir/settings/local.settings.php";
  }
}
