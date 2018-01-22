<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Setup;

use Lucacracco\RoboDrupal8\Robo\Common\RandomString;
use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;

/**
 * Class SettingsCommand.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Setup
 */
class SettingsCommand extends RoboDrupal8Tasks {

  /**
   * Installs RD8 git hooks to local .git/hooks directory.
   *
   * @command setup:git-hooks
   *
   * @throws \Exception
   */
  public function gitHooks() {
    foreach (['pre-commit', 'commit-msg'] as $hook) {
      $this->installGitHook($hook);
    }
  }

  /**
   * Installs a given git hook.
   *
   * This symlinks the hook into the project's .git/hooks directory.
   *
   * @param string $hook
   *   The git hook to install. E.g., 'pre-commit'.
   *
   * @throws \Exception
   */
  protected function installGitHook($hook) {
    if ($this->getConfigValue('git.hooks.' . $hook)) {
      $this->say("Installing $hook git hook...");
      $source = $this->getConfigValue('git.hooks.' . $hook) . "/$hook";
      $dest = $this->getConfigValue('git.root') . "/.git/hooks/$hook";

      $result = $this->taskFilesystemStack()
        ->mkdir($this->getConfigValue('git.root') . '/.git/hooks')
        ->remove($dest)
        ->symlink($source, $dest)
        ->stopOnFail()
        ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
        ->run();

      if (!$result->wasSuccessful()) {
        throw new \Exception("Unable to install $hook git hook.");
      }
    }
    else {
      $this->say("Skipping installation of $hook git hook");
    }
  }

  /**
   * Writes a hash salt to ${project.root}/salt.txt if one does not exist.
   *
   * @command setup:settings:hash-salt
   *
   * @return int
   *   A CLI exit code.
   *
   * @throws \Exception
   */
  public function hashSalt() {
    $hash_salt_file = $this->getConfigValue('project.root') . '/salt.txt';
    if (!file_exists($hash_salt_file)) {
      $this->say("Generating hash salt...");
      $result = $this->taskWriteToFile($hash_salt_file)
        ->line(RandomString::string(55))
        ->run();

      if (!$result->wasSuccessful()) {
        $filepath = $this->getInspector()
          ->getFs()
          ->makePathRelative($hash_salt_file, $this->getConfigValue('project.root'));
        throw new \Exception("Unable to write hash salt to $filepath.");
      }

      return $result->getExitCode();
    }
    else {
      $this->say("Hash salt already exists.");
      return 0;
    }
  }

  /**
   * Generates default settings files for Drupal and drush.
   *
   * TODO: re-implement!.
   *
   * @command setup:settings
   */
  public function generateSiteConfigFiles() {
    if (!file_exists($this->getConfigValue('blt.config-files.local'))) {
      $result = $this->taskFilesystemStack()
        ->copy($this->getConfigValue('blt.config-files.example-local'), $this->getConfigValue('blt.config-files.local'))
        ->stopOnFail()
        ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
        ->run();

      if (!$result->wasSuccessful()) {
        $filepath = $this->getInspector()
          ->getFs()
          ->makePathRelative($this->getConfigValue('blt.config-files.local'), $this->getConfigValue('repo.root'));
        throw new \Exception("Unable to create $filepath.");
      }
    }

    $default_multisite_dir = $this->getConfigValue('docroot') . "/sites/default";
    $default_project_default_settings_file = "$default_multisite_dir/default.settings.php";

    $multisites = $this->getConfigValue('multisites');
    $initial_site = $this->getConfigValue('site');
    $current_site = $initial_site;

    foreach ($multisites as $multisite) {
      if ($current_site != $multisite) {
        $this->switchSiteContext($multisite);
        $current_site = $multisite;
      }

      // Generate settings.php.
      $multisite_dir = $this->getConfigValue('docroot') . "/sites/$multisite";
      $project_default_settings_file = "$multisite_dir/default.settings.php";
      $project_settings_file = "$multisite_dir/settings.php";

      // Generate local.settings.php.
      $blt_local_settings_file = $this->getConfigValue('blt.root') . '/settings/default.local.settings.php';
      $default_local_settings_file = "$multisite_dir/settings/default.local.settings.php";
      $project_local_settings_file = "$multisite_dir/settings/local.settings.php";

      // Generate local.drushrc.php.
      $blt_local_drush_file = $this->getConfigValue('blt.root') . '/settings/default.local.drushrc.php';
      $default_local_drush_file = "$multisite_dir/default.local.drushrc.php";
      $project_local_drush_file = "$multisite_dir/local.drushrc.php";

      $copy_map = [
        $blt_local_settings_file => $default_local_settings_file,
        $default_local_settings_file => $project_local_settings_file,
        $blt_local_drush_file => $default_local_drush_file,
        $default_local_drush_file => $project_local_drush_file,
      ];

      // Only add the settings file if the default exists.
      if (file_exists($default_project_default_settings_file)) {
        $copy_map[$default_project_default_settings_file] = $project_default_settings_file;
        $copy_map[$project_default_settings_file] = $project_settings_file;
      }
      else {
        $this->logger->warning("No $default_project_default_settings_file file found.");
      }

      $task = $this->taskFilesystemStack()
        ->stopOnFail()
        ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
        ->chmod($multisite_dir, 0777);

      if (file_exists($project_settings_file)) {
        $task->chmod($project_settings_file, 0777);
      }

      // Copy files without overwriting.
      foreach ($copy_map as $from => $to) {
        if (!file_exists($to)) {
          $task->copy($from, $to);
        }
      }

      $result = $task->run();

      foreach ($copy_map as $from => $to) {
        $this->getConfig()->expandFileProperties($to);
      }

      if (!$result->wasSuccessful()) {
        throw new \Exception("Unable to copy files settings files from BLT into your repository.");
      }

      $result = $this->taskWriteToFile($project_settings_file)
        ->appendUnlessMatches('#vendor/acquia/blt/settings/blt.settings.php#', 'require DRUPAL_ROOT . "/../vendor/acquia/blt/settings/blt.settings.php";' . "\n")
        ->append(TRUE)
        ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
        ->run();

      if (!$result->wasSuccessful()) {
        throw new \Exception("Unable to modify $project_settings_file.");
      }

      $result = $this->taskFilesystemStack()
        ->chmod($project_settings_file, 0644)
        ->stopOnFail()
        ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
        ->run();

      if (!$result->wasSuccessful()) {
        $filepath = $this->getInspector()
          ->getFs()
          ->makePathRelative($project_settings_file, $this->getConfigValue('repo.root'));
        throw new \Exception("Unable to set permissions on $project_settings_file.");
      }
    }

    if ($current_site != $initial_site) {
      $this->switchSiteContext($initial_site);
    }
  }

}