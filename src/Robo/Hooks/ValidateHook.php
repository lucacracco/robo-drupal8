<?php

namespace Lucacracco\RoboDrupal8\Robo\Hooks;

use Consolidation\AnnotatedCommand\CommandData;
use Lucacracco\RoboDrupal8\Robo\Config\ConfigAwareTrait;
use Lucacracco\RoboDrupal8\Robo\Inspector\InspectorAwareInterface;
use Lucacracco\RoboDrupal8\Robo\Inspector\InspectorAwareTrait;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Robo\Common\IO;
use Robo\Contract\ConfigAwareInterface;

/**
 * This class provides hooks that validate configuration or state.
 *
 * These hooks should not directly provide user interaction. They should throw
 * and exception if a required condition is not met.
 *
 * Typically, each validation hook has an accompanying interact hook (which
 * runs prior to the validation hook). The interact hooks provide an
 * opportunity to the user to resolve the invalid configuration prior to an
 * exception being thrown.
 *
 * @see https://github.com/consolidation/annotated-command#validate-hook
 */
class ValidateHook implements ConfigAwareInterface, LoggerAwareInterface, InspectorAwareInterface {

  use ConfigAwareTrait;
  use LoggerAwareTrait;
  use InspectorAwareTrait;
  use IO;

  /**
   * Validates that the Drupal docroot exists.
   *
   * @hook validate @validateDocrootIsPresent
   */
  public function validateDocrootIsPresent(CommandData $commandData) {
    if (!$this->getInspector()->isDocrootPresent()) {
      throw new \Exception("Unable to find Drupal docroot.");
    }
  }

  /**
   * Validates that the repository root exists.
   *
   * @hook validate @validateRepoRootIsPresent
   */
  public function validateRepoRootIsPresent(CommandData $commandData) {
    if (empty($this->getInspector()->isRepoRootPresent())) {
      throw new \Exception("Unable to find repository root.");
    }
  }

  /**
   * Validates that the Drupal configuration sync exists.
   *
   * @hook validate @validateDrupalConfigurationDirectorySync
   */
  public function validateDrupalConfigurationDirectorySync(CommandData $commandData) {
    if (!$this->getInspector()->isConfigurationDirectorySyncPresent()) {
      throw new \Exception("Unable to find Drupal configuration sync.");
    }
  }

  /**
   * Validates that Drupal is installed.
   *
   * @hook validate @validateDrupalIsInstalled
   */
  public function validateDrupalIsInstalled(CommandData $commandData) {
    if (!$this->getInspector()
      ->isDrupalInstalled()
    ) {

      throw new \Exception("Drupal is not installed");
    }
  }

  /**
   * Checks active settings.php file.
   *
   * @hook validate @validateSettingsFileIsValid
   */
  public function validateSettingsFileIsValid(CommandData $commandData) {
    if (!$this->getInspector()->isDrupalSettingsFilePresent()) {
      throw new \Exception("Could not find settings.php for this site.");
    }

    if (!$this->getInspector()->isDrupalSettingsFileValid()) {
      throw new \Exception("Robo-Drupal8 settings are not included in settings file.");
    }
  }

  /**
   * Validates that MySQL is available.
   *
   * @hook validate @validateMySqlAvailable
   *
   * @throws \Exception
   */
  public function validateMySqlAvailable() {
    if (!$this->getInspector()->isMySqlAvailable()) {
      throw new \Exception("MySql is not available.");
    }
  }

  /**
   * Validates that required settings files exist.
   *
   * @hook validate @validateSettingsFilesPresent
   */
  public function validateSettingsFilesPresent() {
    if (!$this->getInspector()->isHashSaltPresent()) {
      throw new \Exception("salt.txt is not present. Please run `rd8 setup:settings` to generate it.");
    }
    if (!$this->getInspector()->isDrupalLocalSettingsFilePresent()) {
      throw new \Exception("Could not find settings.php for this site.");
    }
  }

}
