<?php

namespace Lucacracco\Drupal8\Robo\Task\Site;

use Lucacracco\Drupal8\Robo\Utility\PathResolver;

/**
 * Robo task base: Set up file system.
 */
class SetupFileSystem extends SiteTask {

  /**
   * Set tasks collection for clear files and structure site.
   *
   * @return $this
   */
  public function clear() {
    $site_directory = PathResolver::siteDirectory();
    $this->collection->addCode(function () {
      $this->printTaskInfo("Clear");
    }
    );
    $this->collection->add($this->collectionBuilder()->taskFilesystemStack()
      ->chmod($site_directory, 0775, 0000, TRUE)
      ->chmod($site_directory, 0775)
      ->remove($site_directory . '/files')
      ->remove($site_directory . '/settings.php')
      ->remove($site_directory . '/services.yml')
    );

    return $this;
  }

  /**
   * Set tasks collection for init files and structure site.
   *
   * @return $this
   */
  public function init() {
    $site_directory = PathResolver::siteDirectory();
    $this->collection->addCode(function () {
      $this->printTaskInfo("Init");
    }
    );
    $this->collection->add(
      $this->collectionBuilder()->taskFilesystemStack()
        ->chmod($site_directory, 0775, 0000, TRUE)
        ->mkdir($site_directory . '/files')
        ->chmod($site_directory . '/files', 0775, 0000, TRUE)
        ->copy($site_directory . '/default.settings.php', $site_directory . '/settings.php')
        ->copy($site_directory . '/default.services.yml', $site_directory . '/services.yml')
    );
    return $this;
  }

}
