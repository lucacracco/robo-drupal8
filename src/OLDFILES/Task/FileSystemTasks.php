<?php

namespace Lucacracco\Drupal8\Robo\Task;

/**
 * Class FileSystemTasks.
 *
 * @package Lucacracco\Drupal8\Robo\Task\Site
 */
class FileSystemTasks extends BaseTasks {

  /**
   * Tasks collection for clear files and structure site.
   *
   * @return $this
   */
  public function clearFilesSite() {
    $this->collection->add($this->collectionBuilder()->taskFilesystemStack()
      ->chmod($this->siteDir, 0775, 0000, TRUE)
      ->chmod($this->siteDir, 0775)
      ->remove($this->siteDir . '/files')
      ->remove($this->siteDir . '/settings.php')
      ->remove($this->siteDir . '/services.yml')
    );
    return $this;
  }

  /**
   * Tasks collection for init files and structure site.
   *
   * @return $this
   */
  public function createFilesSite() {
    $this->collection->add(
      $this->collectionBuilder()->taskFilesystemStack()
        ->chmod($this->siteDir, 0775, 0000, TRUE)
        ->mkdir($this->siteDir . '/files')
        ->chmod($this->siteDir . '/files', 0775, 0000, TRUE)
        ->copy($this->siteDir . '/default.settings.php', $this->siteDir . '/settings.php')
        ->copy($this->siteDir . '/default.services.yml', $this->siteDir . '/services.yml')
    );
    return $this;
  }

}
