<?php

namespace Lucacracco\Drupal8\Robo\Common;

/**
 * Class GlobalsCache.
 *
 * @package Lucacracco\Drupal8\Robo\Common
 */
trait GlobalsCache {

  /**
   * Cache root path in global variable.
   *
   * @param string $cid
   *   CID name
   * @param null|mixed $data
   *   Data to save.
   *
   * @return mixed
   *   The cached root path.
   *
   * @throws \Exception
   *
   */
  protected static function globalCacheVariable($cid, $data = NULL) {

    if (isset($data) && !empty($data)) {
      if (isset($GLOBALS[$cid]) && !empty($GLOBALS[$cid])) {
        throw new \Exception(__CLASS__ . ' - Is already initialized.');
      }

      $GLOBALS[$cid] = $data;
    }

    if (!isset($GLOBALS[$cid]) || empty($GLOBALS[$cid])) {
      throw new \Exception(__CLASS__ . ' - Not initialized.');
    }

    return $GLOBALS[$cid];
  }

}
