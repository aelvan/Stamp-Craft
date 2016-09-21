<?php
namespace craft\plugins\stamp\variables;

use craft\plugins\stamp\Stamp;

class StampVariable
{
    /**
     * Main stamp template variable. Gets timestamp of file and outputs the filename in different ways.
     *
     * @param $fileName
     * @param string $mode
     * @return int|string
     */
    public function er($fileName, $mode = 'file')
    {
        $documentRoot = Stamp::$plugin->stamp->getSetting('stampPublicRoot') != null ? Stamp::$plugin->stamp->getSetting('stampPublicRoot') : $_SERVER['DOCUMENT_ROOT'];
        $filePath = $this->_removeDoubleSlashes($documentRoot . '/' . $fileName);
        
        if ($fileName != '' && file_exists($filePath)) {
            $path_parts = pathinfo($fileName);

            if ($mode == 'file') {
                return $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . filemtime($filePath) . '.' . $path_parts['extension'];
            }
            if ($mode == 'folder') {
                return $path_parts['dirname'] . '/' . filemtime($filePath) . '/' . $path_parts['filename'] . '.' . $path_parts['extension'];
            }
            if ($mode == 'query') {
                return $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . $path_parts['extension'] . '?ts=' . filemtime($filePath);
            }
            if ($mode == 'tsonly') {
                return filemtime($filePath);
            }
        }
            
        return '';
    }
    
     /**
     * Removes double slashes from string
     * 
     * @param $path
     * @return mixed
     */
    private function _removeDoubleSlashes($path)
    {
        return preg_replace('#/+#','/',$path);
    }
}