<?php

namespace Lucacracco\RoboDrupal8\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Installer\PackageEvent;
use Composer\DependencyResolver\Operation\InstallOperation;
use Composer\DependencyResolver\Operation\UpdateOperation;
use Composer\Package\PackageInterface;
use Composer\Installer\PackageEvents;
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
   * @var Composer
   */
  protected $composer;

  /**
   * @var IOInterface
   */
  protected $io;

  /**
   * @var EventDispatcher
   */
  protected $eventDispatcher;

  /**
   * @var ProcessExecutor
   */
  protected $executor;

  /**
   * @var \Composer\Package\PackageInterface
   */
  protected $bltPackage;

  /**
   * Apply plugin modifications to composer.
   *
   * @param Composer $composer
   * @param IOInterface $io
   */
  public function activate(Composer $composer, IOInterface $io) {
    $this->composer = $composer;
    $this->io = $io;
    $this->eventDispatcher = $composer->getEventDispatcher();
    ProcessExecutor::setTimeout(3600);
    $this->executor = new ProcessExecutor($this->io);
  }

  /**
   * Returns an array of event names this subscriber wants to listen to.
   */
  public static function getSubscribedEvents() {
    return [
      ScriptEvents::PRE_INSTALL_CMD => array(
        array('scaffoldComposerIncludes', self::CALLBACK_PRIORITY),
        array('checkInstallerPaths'),
      ),
      ScriptEvents::POST_UPDATE_CMD => array(
        array('scaffoldComposerIncludes', self::CALLBACK_PRIORITY),
      ),
      ScriptEvents::PRE_AUTOLOAD_DUMP => array(
        array('scaffoldComposerIncludes', self::CALLBACK_PRIORITY),
      ),
    ];
  }

  /**
   * Creates or updates composer include files.
   *
   * @param \Composer\Script\Event $event
   */
  public function scaffoldComposerIncludes(Event $event) {

    $files = array(
      'composer.required.json',
      'composer.suggested.json',
    );

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

}
