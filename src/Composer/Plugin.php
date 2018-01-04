<?php

namespace Lucacracco\RoboDrupal8\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;
use Composer\Util\ProcessExecutor;
use Composer\Util\Filesystem;

/**
 * Class Plugin.
 *
 * @package Lucacracco\RoboDrupal8\Composer
 */
class Plugin implements PluginInterface, EventSubscriberInterface {

  /**
   * Package name
   */
  const PACKAGE_NAME = 'lucacracco/robo-drupal8';

  /**
   * RD8 config directory.
   */
  const RD8_DIR = 'robo-drupal8';

  /**
   * Priority that plugin uses to register callbacks.
   */
  const CALLBACK_PRIORITY = 60000;

  /**
   * @var \Composer\Composer
   */
  protected $composer;

  /**
   * @var \Composer\IO\IOInterface
   */
  protected $io;

  /**
   * @var \Composer\Util\ProcessExecutor
   */
  protected $executor;

  /**
   * Returns an array of event names this subscriber wants to listen to.
   */
  public static function getSubscribedEvents() {
    return [
      ScriptEvents::PRE_INSTALL_CMD => [
        ['scaffoldComposerIncludes', self::CALLBACK_PRIORITY],
      ],
      ScriptEvents::POST_UPDATE_CMD => [
        ['scaffoldComposerIncludes', self::CALLBACK_PRIORITY],
      ],
      ScriptEvents::PRE_AUTOLOAD_DUMP => [
        ['scaffoldComposerIncludes', self::CALLBACK_PRIORITY],
      ],
    ];
  }

  /**
   * Apply plugin modifications to composer.
   *
   * @param Composer $composer
   * @param IOInterface $io
   */
  public function activate(Composer $composer, IOInterface $io) {
    $this->composer = $composer;
    $this->io = $io;
    ProcessExecutor::setTimeout(3600);
    $this->executor = new ProcessExecutor($this->io);
  }

  /**
   * Creates or updates composer include files.
   *
   * @param \Composer\Script\Event $event
   */
  public function scaffoldComposerIncludes(Event $event) {

    $files = [
      'composer.required.json',
      'composer.suggested.json',
    ];

    $dir = $this->getRepoRoot() . DIRECTORY_SEPARATOR . self::RD8_DIR;
    $package_dir = $this->getVendorPath() . DIRECTORY_SEPARATOR . self::PACKAGE_NAME;
    if ($this->createDirectory($dir)) {
      foreach ($files as $file) {
        $source = $package_dir . DIRECTORY_SEPARATOR . $file;
        $target = $dir . DIRECTORY_SEPARATOR . $file;
        if (file_exists($source)) {
          if (!file_exists($target) || md5_file($source) != md5_file($target)) {
            $this->io->write("Copying $source to $target");
            copy($source, $target);
          }
        }
      }
    }

    $directories = [
      'config',
      'patches',
    ];
    foreach ($directories as $directory) {
      $directory_path = $this->getRepoRoot() . DIRECTORY_SEPARATOR . $directory;
      if(file_exists($directory)){
        continue;
      }
      if ($this->createDirectory($directory_path)) {
        $this->io->write("Directory $directory_path created.");
      }else{
        $this->io->write("<error>Directory $directory_path not writable or not found.</error>");
      }
    }
  }

  /**
   * Returns the repo root's filepath, assumed to be one dir above vendor dir.
   *
   * @return string
   *   The file path of the repository root.
   */
  public function getRepoRoot() {
    return dirname($this->getVendorPath());
  }

  /**
   * Get the path to the 'vendor' directory.
   *
   * @return string
   */
  public function getVendorPath() {
    $config = $this->composer->getConfig();
    $filesystem = new Filesystem();
    $filesystem->ensureDirectoryExists($config->get('vendor-dir'));
    $vendorPath = $filesystem->normalizePath(realpath($config->get('vendor-dir')));

    return $vendorPath;
  }

  /**
   * Create a new directory.
   *
   * @return bool
   *   TRUE if directory exists or is created.
   */
  protected function createDirectory($path) {
    return is_dir($path) || mkdir($path);
  }

  /**
   * Executes a shell command with escaping.
   *
   * Example usage: $this->executeCommand("test command %s", [ $value ]).
   *
   * @param string $cmd
   * @param array $args
   * @param bool $display_output
   *   Optional. Defaults to FALSE. If TRUE, command output will be displayed
   *   on screen.
   *
   * @return bool
   *   TRUE if command returns successfully with a 0 exit code.
   */
  protected function executeCommand($cmd, $args = [], $display_output = FALSE) {
    // Shell-escape all arguments.
    foreach ($args as $index => $arg) {
      $args[$index] = escapeshellarg($arg);
    }
    // Add command as first arg.
    array_unshift($args, $cmd);
    // And replace the arguments.
    $command = call_user_func_array('sprintf', $args);
    $output = '';
    if ($this->io->isVerbose() || $display_output) {
      $this->io->write('<comment> > ' . $command . '</comment>');
      $io = $this->io;
      $output = function ($type, $buffer) use ($io) {
        $io->write($buffer, FALSE);
      };
    }
    return ($this->executor->execute($command, $output) == 0);
  }

}
