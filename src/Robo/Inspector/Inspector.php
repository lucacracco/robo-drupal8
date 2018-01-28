<?php

namespace Lucacracco\RoboDrupal8\Robo\Inspector;

use function file_exists;
use League\Container\ContainerAwareInterface;
use League\Container\ContainerAwareTrait;
use Lucacracco\RoboDrupal8\Robo\Common\Executor;
use Lucacracco\RoboDrupal8\Robo\Config\ConfigAwareTrait;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Robo\Common\BuilderAwareTrait;
use Robo\Common\IO;
use Robo\Contract\BuilderAwareInterface;
use Robo\Contract\ConfigAwareInterface;
use Robo\Robo;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

/**
 * Class Inspector.
 */
class Inspector implements BuilderAwareInterface, ConfigAwareInterface, ContainerAwareInterface, LoggerAwareInterface {

  use BuilderAwareTrait;
  use ConfigAwareTrait;
  use ContainerAwareTrait;
  use LoggerAwareTrait;
  use Io;

  /**
   * Process executor.
   *
   * @var \Lucacracco\RoboDrupal8\Robo\Common\Executor
   */
  protected $executor;

  /**
   * @var null
   */
  protected $isDrupalInstalled = NULL;

  /**
   * @var null
   */
  protected $isMySqlAvailable = NULL;

  /**
   * @var \Symfony\Component\Filesystem\Filesystem
   */
  protected $fs;

  /**
   * @var bool
   */
  protected $warningsIssued = FALSE;

  /**
   * The constructor.
   *
   * @param \Lucacracco\RoboDrupal8\Robo\Common\Executor $executor
   */
  public function __construct(Executor $executor) {
    $this->executor = $executor;
    $this->fs = new Filesystem();
  }

  /**
   * Executes a command.
   *
   * @param string $command
   *   The command.
   *
   * @return \Robo\Common\ProcessExecutor
   *   The unexecuted command.
   */
  public function execute($command) {
    /** @var \Robo\Common\ProcessExecutor $process_executor */
    $process_executor = Robo::process(new Process($command));
    return $process_executor->dir($this->getConfigValue('repo.root'))
      ->printOutput(FALSE)
      ->printMetadata(FALSE)
      ->interactive(FALSE);
  }

  /**
   * @return \Symfony\Component\Filesystem\Filesystem
   */
  public function getFs() {
    return $this->fs;
  }

  /**
   * @param \Symfony\Component\Filesystem\Filesystem $fs
   */
  public function setFs($fs) {
    $this->fs = $fs;
  }

  /**
   * Clear state.
   */
  public function clearState() {
    $this->isDrupalInstalled = NULL;
    $this->isMySqlAvailable = NULL;
  }

  /**
   * Determines if the repository root directory exists.
   *
   * @return bool
   *   TRUE if file exists.
   */
  public function isRepoRootPresent() {
    return file_exists($this->getConfigValue('repo.root'));
  }

  /**
   * Determines if the Drupal docroot directory exists.
   *
   * @return bool
   *   TRUE if file exists.
   */
  public function isDocrootPresent() {
    return file_exists($this->getConfigValue('docroot'));
  }

  /**
   * Determines if configuration directory sync directory exists.
   *
   * @return bool
   *   TRUE if file exists.
   */
  public function isConfigurationDirectorySyncPresent() {
    return file_exists($this->getConfigValue('drupal.config_directories.sync'));
  }

  /**
   * Determines if Drupal settings.php file exists.
   *
   * @return bool
   *   TRUE if file exists.
   */
  public function isDrupalSettingsFilePresent() {
    return file_exists($this->getConfigValue('drupal.settings_file'));
  }

  /**
   * Determines if salt.txt file exists.
   *
   * @return bool
   *   TRUE if file exists.
   */
  public function isHashSaltPresent() {
    return file_exists($this->getConfigValue('repo.root') . '/salt.txt');
  }

  /**
   * Determines if Drupal local.settings.php file exists.
   *
   * @return bool
   *   TRUE if file exists.
   */
  public function isDrupalLocalSettingsFilePresent() {
    return file_exists($this->getConfigValue('drupal.local_settings_file'));
  }

  /**
   * Determines if Drupal settings.php contains required RD8 includes.
   *
   * @return bool
   *   TRUE if settings.php is valid for RD8 usage.
   */
  public function isDrupalSettingsFileValid() {
    $settings_file_contents = file_get_contents($this->getConfigValue('drupal.settings_file'));
    if (!strstr($settings_file_contents,
      '/../vendor/lucacracco/robo-drupal8/settings/rd8.settings.php')
    ) {
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Checks that Drupal is installed, caches result.
   *
   * This method caches its result in $this->drupalIsInstalled.
   *
   * @return bool
   *   TRUE if Drupal is installed.
   */
  public function isDrupalInstalled() {
    // This will only run once per command. If Drupal is installed mid-command,
    // this value needs to be changed.
    if (is_null($this->isDrupalInstalled)) {
      $this->isDrupalInstalled = $this->getDrupalInstalled();
    }

    return $this->isDrupalInstalled;
  }

  /**
   * Gets the result of `drush status`.
   *
   * @return array
   *   The result of `drush status`.
   */
  public function getDrushStatus() {
    $status_info = json_decode($this->executor->drush('status --format=json --show-passwords')
      ->run()
      ->getMessage(), TRUE);

    return $status_info;
  }

  /**
   * Validates a drush alias.
   *
   * @param string $alias
   *
   * @return bool
   *   TRUE if alias is valid.
   */
  public function isDrushAliasValid($alias) {
    return $this->executor->drush("site:alias $alias --format=json")
      ->run()
      ->wasSuccessful();
  }

  /**
   * Determines if MySQL is available, caches result.
   *
   * This method caches its result in $this->mySqlAvailable.
   *
   * @return bool
   *   TRUE if MySQL is available.
   */
  public function isMySqlAvailable() {
    if (is_null($this->isMySqlAvailable)) {
      $this->isMySqlAvailable = $this->getMySqlAvailable();
    }

    return $this->isMySqlAvailable;
  }

  /**
   * Determines if MySQL is available. Uses MySQL credentials from Drush.
   *
   * This method does not cache its result.
   *
   * @return bool
   *   TRUE if MySQL is available.
   */
  public function getMySqlAvailable() {
    $this->logger->debug("Verifying that MySQL is available...");
    /** @var \Robo\Result $result */
    $result = $this->executor->drush("sqlq \"SHOW DATABASES\"")
      ->run();

    return $result->wasSuccessful();
  }

  /**
   * Checks to see if RD( alias is installed on CLI.
   *
   * @return bool
   *   TRUE if RD8 alias is installed.
   */
  public function isRd8AliasInstalled() {
    $cli_config_file = $this->getCliConfigFile();
    if (!is_null($cli_config_file) && file_exists($cli_config_file)) {
      $contents = file_get_contents($cli_config_file);
      if (strstr($contents, 'function rd8')) {
        return TRUE;
      }
    }

    return FALSE;
  }

  /**
   * Determines the CLI config file.
   *
   * @return null|string
   *   Returns file path or NULL if none was found.
   */
  public function getCliConfigFile() {
    $file = NULL;
    $user = posix_getpwuid(posix_getuid());
    $home_dir = $user['dir'];

    if (!empty($_ENV['SHELL']) && strstr($_ENV['SHELL'], 'zsh')) {
      $file = $home_dir . '/.zshrc';
    }
    elseif (file_exists($home_dir . '/.bash_profile')) {
      $file = $home_dir . '/.bash_profile';
    }
    elseif (file_exists($home_dir . '/.bashrc')) {
      $file = $home_dir . '/.bashrc';
    }
    elseif (file_exists($home_dir . '/.profile')) {
      $file = $home_dir . '/.profile';
    }
    elseif (file_exists($home_dir . '/.functions')) {
      $file = $home_dir . '/.functions';
    }

    return $file;
  }

  /**
   * Checks if a given command exists on the system.
   *
   * @param string $command
   *   The command binary only. E.g., "drush" or "php".
   *
   * @return bool
   *   TRUE if the command exists, otherwise FALSE.
   */
  public function commandExists($command) {
    exec("command -v $command >/dev/null 2>&1", $output, $exit_code);
    return $exit_code == 0;
  }

  /**
   * Verifies that installed minimum git version is met.
   *
   * @param string $minimum_version
   *   The minimum git version that is required.
   *
   * @return bool
   *   TRUE if minimum version is satisfied.
   */
  public function isGitMinimumVersionSatisfied($minimum_version) {
    exec("git --version | cut -d' ' -f3", $output, $exit_code);
    if (version_compare($output[0], $minimum_version, '>=')) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Determines if all file in a given array exist.
   *
   * @return bool
   *   TRUE if all files exist.
   */
  public function filesExist($files) {
    foreach ($files as $file) {
      if (!file_exists($file)) {
        $this->logger->warning("Required file $file does not exist.");
        return FALSE;
      }
    }

    return TRUE;
  }

  /**
   * Throws an exception if the minimum PHP version is not met.
   */
  public function warnIfPhpOutdated() {
    $minimum_php_version = 5.6;
    $current_php_version = phpversion();
    if ($current_php_version < $minimum_php_version) {
      throw new \Exception("Robo-Drupal8 requires PHP $minimum_php_version or greater. You are using $current_php_version.");
    }
  }

  /**
   * Determines if the active config is identical to sync directory.
   *
   * @return bool
   *   TRUE if config is identical.
   */
  public function isActiveConfigIdentical() {
    $identical = FALSE;
    $result = $this->executor->drush("cex --no")
      ->run();
    $message = trim($result->getMessage());
    if (strpos($message, 'The active configuration is identical to the configuration in the export directory')) {
      $identical = TRUE;
    }
    return $identical;
  }

  /**
   * Determines if Drupal is installed.
   *
   * This method does not cache its result.
   *
   * @return bool
   *   TRUE if Drupal is installed.
   */
  protected function getDrupalInstalled() {
    $this->logger->debug("Verifying that Drupal is installed...");
    $result = $this->executor->drush("sqlq \"SHOW TABLES LIKE 'config'\"")
      ->run();
    $output = trim($result->getMessage());
    $installed = $result->wasSuccessful() && $output == 'config';

    return $installed;
  }

  /**
   * Warns the user if the xDebug extension is loaded.
   */
  protected function warnIfXdebugLoaded() {
    $xdebug_loaded = extension_loaded('xdebug');
    if ($xdebug_loaded) {
      $this->logger->warning("The xDebug extension is loaded. This will significantly decrease performance.");
    }
  }
}
