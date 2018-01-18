<?php

namespace Lucacracco\RoboDrupal8\Robo\Config;

use DrupalFinder\DrupalFinder;
use Symfony\Component\Finder\Finder;

/**
 * Default configuration for Robo-Drupal8.
 *
 * @package Lucacracco\RoboDrupal8\Robo\Config
 */
class DefaultConfig extends RoboDrupal8Config {

  /**
   * DefaultConfig constructor.
   *
   * @param string $project_root
   *   The repository root of the project that depends on RD8.
   *
   * @throws \Exception
   */
  public function __construct($project_root) {
    parent::__construct();
    $drupalFinder = new DrupalFinder();
    $drupalFinder->locateRoot($project_root);
    $this->set('project.root', $project_root);
    $this->set('docroot', $drupalFinder->getDrupalRoot());
    $this->set('rd8.root', $this->getRd8Root());
    $this->set('composer.bin', $drupalFinder->getVendorDir() . '/bin');
  }

  /**
   * Populates configuration settings not available during construction.
   */
  public function populateHelperConfig() {
    $defaultAlias = $this->get('drush.default_alias');
    $alias = $defaultAlias == 'self' ? '' : $defaultAlias;
    $this->set('drush.alias', $alias);
    $site_dirs = $this->getSiteDirs();
    $first_site = reset($site_dirs);
    $site = $this->get('site', $first_site);
    $this->setSite($site);
  }

  /**
   * @param $site
   */
  public function setSite($site) {
    $this->config->set('site', $site);
    if (!$this->get('drush.uri')) {
      $this->set('drush.uri', $site);
    }
  }

  /**
   * Gets the RD8 root directory. E.g., /vendor/lucacracco/robo-drupal8.
   *
   * @return string
   *   THe filepath for the Drupal docroot.
   *
   * @throws \Exception
   */
  protected function getRd8Root() {
    $possible_rd8_roots = [
      dirname(dirname(dirname(dirname(__FILE__)))),
      dirname(dirname(dirname(__FILE__))),
    ];
    foreach ($possible_rd8_roots as $possible_rd8_root) {
      if (file_exists("$possible_rd8_root/template")) {
        return $possible_rd8_root;
      }
    }

    throw new \Exception('Could not find the Drupal docroot directory');
  }

  /**
   * Gets an array of sites for the Drupal application.
   *
   * I.e., sites under docroot/sites, not including acsf 'g' pseudo-site.
   *
   * @return array
   *   An array of sites.
   */
  protected function getSiteDirs() {
    $sites_dir = $this->get('docroot') . '/sites';
    $sites = [];

    if (!file_exists($sites_dir)) {
      return $sites;
    }

    $finder = new Finder();
    $dirs = $finder
      ->in($sites_dir)
      ->directories()
      ->depth('< 1')
      ->exclude(['g']);
    foreach ($dirs->getIterator() as $dir) {
      $sites[] = $dir->getRelativePathname();
    }

    return $sites;
  }

}
