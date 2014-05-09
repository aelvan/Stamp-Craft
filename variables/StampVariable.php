<?php
namespace Craft;

class StampVariable
{
	public function er($fileName)
	{
    $documentRoot = craft()->stamp->getSetting('stampPublicRoot')!=null ? craft()->stamp->getSetting('stampPublicRoot') : $_SERVER['DOCUMENT_ROOT'];
    $filePath = $documentRoot . $fileName;
    
    if ($fileName != '' && file_exists($filePath)) {
      $path_parts = pathinfo($fileName);
      return $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . filemtime($filePath) .'.' . $path_parts['extension'];
    } else {
      return '';
    }
	}
}