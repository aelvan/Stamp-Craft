<?php
namespace Craft;

class StampVariable
{
  /**
   * Exactly like hash_file except that the result is always numeric
   * (consisting of characters 0-9 only).
   */
  public function num_hash_file($filePath)
  {
    return implode(unpack('C*', hash_file('crc32b', $filePath, true)));
  }

  public function er($fileName, $mode='file', $alg='ts')
  {
    $documentRoot = craft()->stamp->getSetting('stampPublicRoot')!=null ? craft()->stamp->getSetting('stampPublicRoot') : $_SERVER['DOCUMENT_ROOT'];
    $filePath = $documentRoot . $fileName;

    if ($fileName != '' && file_exists($filePath)) {
      $path_parts = pathinfo($fileName);

      $stamp = $alg === 'hash' ? $this->num_hash_file($filePath) : filemtime($filePath);

      if ($mode=='file') {
        return $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . $stamp . '.' . $path_parts['extension'];
      } else if ($mode=='folder') {
        return $path_parts['dirname'] . '/' . $stamp . '/' . $path_parts['filename'] . '.' . $path_parts['extension'];
      } else if ($mode=='query') {
        return $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . $path_parts['extension'] . '?ts=' . $stamp;
      } else if ($mode=='tsonly') {
        return $stamp;
      }
    } else {
      return '';
    }
  }
}