<?php

/**
 * @file
 * Controls configuration management settings.
 */

/**
 * TODO: update for second option will default.
 *
 * RD8 makes the assumption that, if using multisite, the default configuration
 * directory should be shared between all multi-sites, and each multisite will
 * override this selectively using configuration splits. However, some
 * applications may prefer to manage the configuration for each multisite
 * completely separately. If this is the case, they can set
 * $config_directories['sync'] = $dir . "/config/$site_dir" and we will not
 * overwrite it.
 */
if (!isset($config_directories['sync'])) {
  // Configuration directories.
  $config_directories['sync'] = $repo_root . "/config/default";
}

$split_filename_prefix = 'config_split.config_split';
$split_filepath_prefix = $config_directories['sync'] . '/' . $split_filename_prefix;

/**
 * Set environment splits.
 */
$split_envs = [
  'local',
  'dev',
  'test',
  'prod',
];

// Disable all split by default.
foreach ($split_envs as $split_env) {
  $config["$split_filename_prefix.$split_env"]['status'] = FALSE;
}

// Enable env splits.
// Do not set $split unless it is unset. This allows prior scripts to set it.
if (!isset($split)) {
  $split = 'none';

  // Local envs.
  if ($is_local_env) {
    $split = 'local';
  }
  if ($pantheon_env == 'test') {
    $split = 'stage';
  }
}

// Enable the environment split only if it exists.
if ($split != 'none' && file_exists("$split_filepath_prefix.$split.yml")) {
  $config["$split_filename_prefix.$split"]['status'] = TRUE;
}

/**
 * Set multisite split.
 */
if (file_exists("$split_filepath_prefix.$site_dir.yml")) {
  $config["$split_filename_prefix.$site_dir"]['status'] = TRUE;
}

// Set profile split.
if (array_key_exists('install_profile', $settings)) {
  $active_profile = $settings['install_profile'];
  if (file_exists("$split_filepath_prefix.$active_profile.yml")) {
    $config["$split_filename_prefix.$active_profile"]['status'] = TRUE;
  }
}
