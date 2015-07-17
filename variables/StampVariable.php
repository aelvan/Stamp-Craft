<?php
namespace Craft;

class StampVariable
{
	public function er($fileName, $mode='file')
	{
    $documentRoot = craft()->stamp->getSetting('stampPublicRoot')!=null ? craft()->stamp->getSetting('stampPublicRoot') : $_SERVER['DOCUMENT_ROOT'];
    $filePath = $documentRoot . $fileName;
    
    if ($fileName != '' && file_exists($filePath)) {
      $path_parts = pathinfo($fileName);
      
			if ($mode=='file') {
				return $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . filemtime($filePath) . '.' . $path_parts['extension'];
			} else if ($mode=='folder') {
				return $path_parts['dirname'] . '/' . filemtime($filePath) . '/' . $path_parts['filename'] . '.' . $path_parts['extension'];
			} else if ($mode=='query') {
				return $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . $path_parts['extension'] . '?ts=' . filemtime($filePath);
			} else if ($mode=='tsonly') {
				return filemtime($filePath);
			}
    } else {
      return '';
    }
	}
}