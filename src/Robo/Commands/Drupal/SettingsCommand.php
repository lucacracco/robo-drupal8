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

  use \Lucacracco\RoboDrupal8\Robo\Tasks\LoadTasks;

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
   * @hidden
   */
  public function generateSiteConfigFiles() {
    $sites_dir = $this->getConfigValue('project.docroot') . DIRECTORY_SEPARATOR . 'sites';
    $site_dir = $sites_dir . DIRECTORY_SEPARATOR . $this->getConfigValue('site');

    // Set permission of directory parents.
    $task_filesystem = $this->taskFilesystemStack()
      ->stopOnFail()
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
      ->chmod($site_dir, 0777, 0000, TRUE);

    // Create task for manage twig files.
    $task_twig = $this->taskTwigRd8()
      ->setContext($this->getConfig()->export());

    // Required files.
    $templates = [
      'drupal.template_files.services' => $site_dir . DIRECTORY_SEPARATOR . 'services.yml',
      'drupal.template_files.settings' => $site_dir . DIRECTORY_SEPARATOR . 'settings.php',
    ];
    foreach ($templates as $conf_name => $destination) {
      // Remove old file.
      if (file_exists($destination)) {
        $task_filesystem->remove($destination);
      }

      // Load template to use and add in queue for task.
      $template_file = $this->getConfigValueIfNotEmpty($conf_name, NULL);
      if (empty($template_file) || !file_exists($template_file)) {
        throw new \Exception("Template for \"$template_file\" not found");
      }

      $task_twig
        ->addTemplatesDirectory(dirname($template_file))
        ->applyTemplate(basename($template_file), $destination);
    }

    // Optional files.
    $templates = [
      'drupal.template_files.settings_local' => $site_dir . DIRECTORY_SEPARATOR . 'settings.local.php',
      'drupal.template_files.development_services' => $sites_dir . DIRECTORY_SEPARATOR . 'development.yml',
      'drupal.template_files.sites' => $sites_dir . DIRECTORY_SEPARATOR . 'sites.php',
    ];
    foreach ($templates as $conf_name => $destination) {
      // Remove old file.
      if (file_exists($destination)) {
        $task_filesystem->remove($destination);
      }

      // Load template to use and add in queue for task.
      $template_file = $this->getConfigValueIfNotEmpty($conf_name, NULL);
      if (empty($template_file) || !file_exists($template_file)) {
        continue;
      }

      $task_twig
        ->addTemplatesDirectory(dirname($template_file))
        ->applyTemplate(basename($template_file), $destination);
    }

    // Remove files.
    $task_filesystem_result = $task_filesystem->run();
    if (!$task_filesystem_result->wasSuccessful()) {
      throw new \Exception("Unable to delete files settings: " . $task_filesystem_result->getMessage());
    }

    // Print files template.
    $task_twig_result = $task_twig->run();
    if (!$task_twig_result->wasSuccessful()) {
      throw new \Exception("Unable to generate files settings: " . $task_twig_result->getMessage());
    }
    $this->say("Files generate and copied.");

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
   * @hidden
   *
   * @return int
   *   A CLI exit code.
   *
   * @throws \Exception
   */
  public function hashSalt() {
    $dir_private = $this->getConfigValue('drupal.site.directory.private');
    $hash_salt_file = $dir_private . DIRECTORY_SEPARATOR . 'salt.txt';
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
