<?php

namespace Lucacracco\RoboDrupal8\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;
use Composer\Util\ProcessExecutor;
use DrupalFinder\DrupalFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

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
        ['createRequiredFiles', -self::CALLBACK_PRIORITY],
      ],
      ScriptEvents::POST_INSTALL_CMD => [
        'createRequiredFiles',
        -self::CALLBACK_PRIORITY,
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
   * Create required files for project and build.
   *
   * @param \Composer\Script\Event $event
   *
   * @throws \Exception
   */
  public function createRequiredFiles(Event $event) {
    $fs = new Filesystem();
    $drupalFinder = new DrupalFinder();
    $drupalFinder->locateRoot($this->getRepoRoot());
    $drupalRoot = $drupalFinder->getDrupalRoot();

    $dirs = [
      'modules/custom',
      'profiles/custom',
      'themes/custom',
    ];

    // Required.
    foreach ($dirs as $dir) {
      if (!$fs->exists($drupalRoot . '/' . $dir)) {
        try {
          $fs->mkdir($drupalRoot . '/' . $dir);
          $fs->touch($drupalRoot . '/' . $dir . '/.gitkeep');
        } catch (\Exception $exception) {
          print_r($exception->getMessage());
        }
      }
    }

    // Prepare the settings file for installation
    if (!$fs->exists($drupalRoot . '/sites/default/settings.php')
      and $fs->exists($drupalRoot . '/sites/default/default.settings.php')
    ) {

      $fs->copy($drupalRoot . '/sites/default/default.settings.php', $drupalRoot . '/sites/default/settings.php');

      require_once $drupalRoot . '/autoload.php';
      require_once $drupalRoot . '/core/includes/bootstrap.inc';
      require_once $drupalRoot . '/core/includes/install.inc';

      $settings['config_directories'] = [
        CONFIG_SYNC_DIRECTORY => (object) [
          'value' => Path::makeRelative($drupalFinder->getComposerRoot() . '/config/default/sync', $drupalRoot),
          'required' => TRUE,
        ],
      ];


      drupal_rewrite_settings($settings, $drupalRoot . '/sites/default/settings.php');
      $fs->chmod($drupalRoot . '/sites/default/settings.php', 0666);
      $event->getIO()
        ->write("Create a sites/default/settings.php file with chmod 0666");
    }

    // Create the files directory with chmod 0777
    if (!$fs->exists($drupalRoot . '/sites/default/files')) {
      $oldmask = umask(0);
      $fs->mkdir($drupalRoot . '/sites/default/files', 0777);
      umask($oldmask);
      $event->getIO()
        ->write("Create a sites/default/files directory with chmod 0777");
    }
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

    $dir_base = $this->getRepoRoot() . DIRECTORY_SEPARATOR . self::RD8_DIR;
    $dir = $dir_base;
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

      // Copy project configuration.
      $dir = $dir_base . DIRECTORY_SEPARATOR . 'config';
      $source = $package_dir . DIRECTORY_SEPARATOR . 'config/_project.yml';
      $target = $dir . DIRECTORY_SEPARATOR . '_project.yml';
      if ($this->createDirectory($dir)) {
        if (file_exists($source)) {
          if (!file_exists($target)) {
            $this->io->write("Copying $source to $target");
            copy($source, $target);
          }
        }
      }

      // Copy default site configuration.
      $dir = $dir_base . DIRECTORY_SEPARATOR . 'config/sites';
      $source = $package_dir . DIRECTORY_SEPARATOR . 'config/sites/default.yml';
      $target = $dir . DIRECTORY_SEPARATOR . 'default.yml';
      if ($this->createDirectory($dir)) {
        if (file_exists($source)) {
          if (!file_exists($target)) {
            $this->io->write("Copying $source to $target");
            copy($source, $target);
          }
        }
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
    $filesystem = new \Composer\Util\Filesystem();
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
