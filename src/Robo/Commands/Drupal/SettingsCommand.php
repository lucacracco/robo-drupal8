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
   * Generate default settings files for Drupal and drush and generate salt.txt.
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
   * Generates default settings files for Drupal.
   *
   * @command drupal:settings:generate
   */
  public function generateSiteConfigFiles() {

    // Array of copy files.
    $copy_map = [];
    $sites_dir = $this->getConfigValue('docroot') . DIRECTORY_SEPARATOR . 'sites';
    $site_dir = $sites_dir . DIRECTORY_SEPARATOR . $this->getConfigValue('site');

    // TODO: complete implementation for use twig engine.
    //    // Load filesSystemStack.
    //    $task_copy_files = $this->taskFilesystemStack()
    //      ->stopOnFail()
    //      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
    //      ->chmod($site_dir, 0777);
    //
    //    // Load
    //    $task_create_files =  $this->collectionBuilder();
    //
    //    foreach(['default.settings', 'default.services', 'example.settings.local'] as $template){
    //
    //      if(!$this->getConfigValueIfNotEmpty($template, FALSE)){
    //
    //        // Template not defined, use the default tempalte.
    //        $to = "";
    //        if (file_exists($to)) {
    //          $task_copy_files->remove($to);
    //        }
    //        $from = $site_dir . DIRECTORY_SEPARATOR . "{$template}.php";
    //        $task_copy_files->copy($from, $to);
    //        continue;
    //      }
    //
    //      $template_file = $this->getConfigValueIfNotEmpty($template);
    //      $templates_folder = $template_file;
    //      $template_name = $template_file;
    //      $twig_loader = new \Twig_Loader_Filesystem($templates_folder);
    //      $twig = new \Twig_Environment($twig_loader);
    //      $file_rendered = $twig->render($template_name, $this->getConfig()->export());
    //      $task_create_files->taskWriteToFile($template_file)
    //        ->text($file_rendered);
    //    }

    // TODO: remove after implementation use of twig engine.

    // Generate settings.php.
    $settings_template_default = $site_dir . DIRECTORY_SEPARATOR . 'default.settings.php';
    $settings_template = $this->getConfigValueIfNotEmpty('drupal.settings_file', $settings_template_default);
    $copy_map[$settings_template] = $site_dir . DIRECTORY_SEPARATOR . 'settings.php';

    // Generate local.settings.php.
    $local_settings_template_default = $sites_dir . DIRECTORY_SEPARATOR . 'example.settings.local.php';
    $local_settings_template = $this->getConfigValueIfNotEmpty('drupal.local_settings_file', $local_settings_template_default);
    $copy_map[$local_settings_template] = $site_dir . DIRECTORY_SEPARATOR . 'local.settings.php';

    // Generate services.yml.
    $services_template_default = $site_dir . DIRECTORY_SEPARATOR . 'default.services.yml';
    $services_template = $this->getConfigValueIfNotEmpty('drupal.services_file', $services_template_default);
    $copy_map[$services_template] = $site_dir . DIRECTORY_SEPARATOR . 'services.yml';

    // Generate local.drushrc.php.
    //$local_drush_file = $this->getConfigValue('drupal.local_drushrc', NULL);
    //$copy_map[$local_drush_file] = $site_dir . DIRECTORY_SEPARATOR . 'local.drushrc.php';

    $task_copy_files = $this->taskFilesystemStack()
      ->stopOnFail()
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
      ->chmod($site_dir, 0777);

    // Copy files without overwriting.
    foreach ($copy_map as $from => $to) {
      if (!empty($from) && !file_exists($to)) {
        $task_copy_files->copy($from, $to);
      }
    }
    $task_copy_files_result = $task_copy_files->run();
    if (!$task_copy_files_result->wasSuccessful()) {
      throw new \Exception("Unable to copy files settings files: " . $task_copy_files_result->getMessage());
    }
    $this->say("Files copied.");

    // Set permission to settings.php.
    $task_permission_files = $this->taskFilesystemStack()
      ->chmod($site_dir . DIRECTORY_SEPARATOR . 'settings.php', 0644)
      ->stopOnFail()
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE);
    $task_permission_files_result = $task_permission_files->run();
    if (!$task_permission_files_result->wasSuccessful()) {
      throw new \Exception("Unable to set permissions: " . $task_permission_files_result->getMessage());
    }
    $this->say("Permission files applied.");
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