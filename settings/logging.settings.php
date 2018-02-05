<?php

/**
 * @file
 * Display all errors for local and dev envs.
 */

if ($is_local_env || $is_dev_env) {
  error_reporting(E_ALL);
  // Print errors on WSOD.
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
}
