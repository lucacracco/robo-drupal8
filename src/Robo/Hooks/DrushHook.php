<?php

namespace Lucacracco\RoboDrupal8\Robo\Hooks;

use Consolidation\AnnotatedCommand\CommandData;
use Lucacracco\RoboDrupal8\Robo\RoboDrupal8Tasks;

/**
 * Validate Drush configuration for failed commands.
 */
class DrushHook extends RoboDrupal8Tasks {

  /**
   * Validates drush configuration for failed commands.
   *
   * @hook validate @validateDrushConfig
   */
  public function validateDrushConfig(CommandData $commandData) {
    $alias = $this->getConfigValue('drush.alias');
    if ($alias && !$this->getInspector()->isDrushAliasValid("$alias")) {
      $this->logger->error("Invalid drush alias '@$alias'.");
      $this->logger->info('Troubleshooting suggestions:');
      $this->logger->info('Execute `drush site:alias` from within the docroot to see a list of available aliases.');
      $this->logger->info("Execute `drush site:alias $alias` for information on the @$alias alias.");
      $this->logger->info("Execute `drush @$alias status` to determine the status of the application belonging to the alias.");
      throw new \Exception("Invalid drush alias '@$alias'.");
    }
  }

}
