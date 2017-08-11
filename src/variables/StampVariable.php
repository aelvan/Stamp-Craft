<?php
/**
 * Stamp plugin for Craft CMS 3.x
 *
 * A simple plugin for adding timestamps to filenames.
 *
 * @link      https://www.vaersaagod.no
 * @copyright Copyright (c) 2017 André Elvan
 */

namespace aelvan\stamp\variables;

use aelvan\stamp\Stamp;

class StampVariable
{
    /**
     * Main stamp template variable.
     * 
     * @param        $fileName
     * @param string $mode
     *
     * @return string
     */
    public function er($fileName, $mode = 'file'): string
    {
        $documentRoot = Stamp::getInstance()->getSettings()->publicRoot ?? $_SERVER['DOCUMENT_ROOT'];
        $filePath = $this->_removeDoubleSlashes($documentRoot.'/'.$fileName);

        if ($fileName !== '' && file_exists($filePath)) {
            $path_parts = pathinfo($fileName);
            $tstamp = filemtime($filePath);

            if ($mode === 'file') {
                return $path_parts['dirname'].'/'.$path_parts['filename'].'.'.$tstamp.'.'.$path_parts['extension'];
            }

            if ($mode === 'folder') {
                return $path_parts['dirname'].'/'.$tstamp.'/'.$path_parts['filename'].'.'.$path_parts['extension'];
            }

            if ($mode === 'query') {
                return $path_parts['dirname'].'/'.$path_parts['filename'].'.'.$path_parts['extension'].'?ts='.$tstamp;
            }

            if ($mode === 'tsonly') {
                return $tstamp;
            }
        }

        return '';
    }

    /**
     * Removes double slashes from string
     *
     * @param $path
     *
     * @return mixed
     */
    private function _removeDoubleSlashes($path)
    {
        return preg_replace('#/+#', '/', $path);
    }
}