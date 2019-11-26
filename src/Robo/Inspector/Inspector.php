<?php

namespace Lucacracco\RoboDrupal8\Robo\Inspector;

use function file_exists;
use League\Container\ContainerAwareInterface;
use League\Container\ContainerAwareTrait;
use Lucacracco\RoboDrupal8\Robo\Common\Executor;
use Lucacracco\RoboDrupal8\Robo\Common\MySqlConnection;
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
    return $process_executor->dir($this->getConfigValue('project.root'))
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
    return file_exists($this->getConfigValue('project.root'));
  }

  /**
   * Determines if the Drupal docroot directory exists.
   *
   * @return bool
   *   TRUE if file exists.
   */
  public function isDocrootPresent() {
    return file_exists($this->getConfigValue('project.docroot'));
  }

  /**
   * Determines if the database export directory exists.
   *
   * @return bool
   *   TRUE if directory exists.
   */
  public function isDatabaseExportPresent() {
    return file_exists($this->getConfigValue('drupal.databases.backup_dir'));
  }

  /**
   * Determines if configuration directory sync directory exists.
   *
   * @return bool
   *   TRUE if file exists.
   */
  public function isConfigurationDirectorySyncPresent() {
    return file_exists($this->getConfigValue('drupal.site.directory.config'));
  }

  /**
   * Determines if Drupal settings.php file exists.
   *
   * @return bool
   *   TRUE if file exists.
   */
  public function isDrupalSettingsFilePresent() {
    $sites_dir = $this->getConfigValue('project.docroot') . DIRECTORY_SEPARATOR . 'sites';
    $site_dir = $sites_dir . DIRECTORY_SEPARATOR . $this->getConfigValue('site');
    return file_exists($site_dir . DIRECTORY_SEPARATOR . 'services.yml');
  }

  /**
   * Determines if salt.txt file exists.
   *
   * @return bool
   *   TRUE if file exists.
   */
  public function isHashSaltPresent() {
    return file_exists($this->getConfigValue('drupal.site.directory.private') . DIRECTORY_SEPARATOR . 'salt.txt');
  }

  /**
   * Checks that Drupal is installed, caches result.
   *
   * This method caches its result in $this->drupalIsInstalled.
   *
   * TODO: complete. Reload variable when install a new site.
   *
   * @return bool
   *   TRUE if Drupal is installed.
   */
  public function isDrupalInstalled() {
    // This will only run once per command. If Drupal is installed mid-command,
    // this value needs to be changed.
    //if (is_null($this->isDrupalInstalled)) {
    //  $this->isDrupalInstalled = $this->getDrupalInstalled();
    //}
    //return $this->isDrupalInstalled;
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
    $database_config = $this->getConfigValue('drupal.databases.default.default', NULL);
    if (empty($database_config)) {
      return FALSE;
    }
    $db_url = MySqlConnection::convertDatabaseFromDatabaseArray($database_config);

    // TODO: convert use mysql-cli?

    /** @var \Robo\Result $result */
    $result = $this->executor->execute("drush sqlq \"SHOW DATABASES\" --db-url=$db_url")
      ->run();

    return $result->wasSuccessful();
  }

  /**
   * Checks to see if RD8 alias is installed on CLI.
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
    print_r("{$result->getMessage()}\n\n");
    $installed = $result->wasSuccessful() && $output == 'config';

    return $installed;
  }

}
