<?php

namespace Lucacracco\RoboDrupal8\Robo\Commands\Drupal;

use Lucacracco\RoboDrupal8\Robo\Common\RandomString;
use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;
use Robo\Contract\VerbosityThresholdInterface;

/**
 * Defines commands "drupal:settings:*" namespace.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Commands\Drupal
 */
class SettingsCommand extends RoboDrupal8Tasks {

  /**
   * Generate default settinsg files for Drupal and drush and generate salt.txt.
   *
   * @command drupal:settings
   */
  public function settings() {
    $this->invokeCommands([
      'drupal:settings:hash-salt',
      'drupal:settings:generate',
    ]);
  }

  /**
   * Generates default settings files for Drupal and drush.
   *
   * @command drupal:settings:generate
   */
  public function generateSiteConfigFiles() {

    // Array of copy files.
    $copy_map = [];
    $site_dir = $this->getConfigValue('docroot') . DIRECTORY_SEPARATOR . 'sites' . DIRECTORY_SEPARATOR . $this->getConfigValue('site');

    $settings_template_default = $site_dir . DIRECTORY_SEPARATOR . 'default.settings.php';
    $settings_template = $this->getConfigValue('drupal.settings_file', $settings_template_default);
    if (!file_exists($settings_template)) {
      throw new \InvalidArgumentException("Settings template $settings_template not found.");
    }

    // Generate settings.php.
    $copy_map[$settings_template] = $site_dir . DIRECTORY_SEPARATOR . 'settings.php';

    // Generate local.settings.php.
    $local_settings_file = $this->getConfigValue('drupal.local_settings_file', NULL);
    $copy_map[$local_settings_file] = $site_dir . DIRECTORY_SEPARATOR . 'local.settings.php';

    // Generate local.drushrc.php.
    $local_drush_file = $this->getConfigValue('drupal.local_drushrc', NULL);
    $copy_map[$local_drush_file] = $site_dir . DIRECTORY_SEPARATOR . 'local.drushrc.php';

    $task = $this->taskFilesystemStack()
      ->stopOnFail()
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
      ->chmod($site_dir, 0777);

    // Copy files without overwriting.
    foreach ($copy_map as $from => $to) {
      if (!file_exists($to)) {
        $task->copy($from, $to);
      }
    }

    $result = $task->run();

    //    foreach ($copy_map as $from => $to) {
    //      $this->getConfig()->expandFileProperties($to);
    //    }

    if (!$result->wasSuccessful()) {
      throw new \Exception("Unable to copy files settings files.");
    }
  }

  /**
   * Writes a hash salt to ${project.root}/salt.txt if one does not exist.
   *
   * @command drupal:settings:hash-salt
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

}