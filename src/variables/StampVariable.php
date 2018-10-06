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
     * @param string $fileName
     * @param string $mode
     * @param string $alg
     *
     * @return string
     */
    public function er($fileName, $mode = 'file', $alg = 'ts'): string
    {
        $documentRoot = \Yii::getAlias(Stamp::getInstance()->getSettings()->publicRoot ?? '@webroot');
        $filePath = $this->_removeDoubleSlashes($documentRoot . '/' . $fileName);

        if ($fileName !== '' && file_exists($filePath)) {
            $path_parts = pathinfo($fileName);

            $stamp = $alg === 'hash' ? $this->num_hash_file($filePath) : filemtime($filePath);

            if ($mode === 'file') {
                return $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . $stamp . '.' . $path_parts['extension'];
            }

            if ($mode === 'folder') {
                return $path_parts['dirname'] . '/' . $stamp . '/' . $path_parts['filename'] . '.' . $path_parts['extension'];
            }

            if ($mode === 'query') {
                return $path_parts['dirname'] . '/' . $path_parts['filename'] . '.' . $path_parts['extension'] . '?ts=' . $stamp;
            }

            if ($mode === 'tsonly') {
                return $stamp;
            }
        }

        return '';
    }

    /**
     * Removes double slashes from string
     *
     * @param string $path
     * @return mixed
     */
    private function _removeDoubleSlashes($path)
    {
        return preg_replace('#/+#', '/', $path);
    }

    /**
     * Exactly like hash_file except that the result is always numeric
     * (consisting of characters 0-9 only).
     *
     * @param string $filePath
     * @return string
     */
    public function num_hash_file($filePath)
    {
        return implode(unpack('C*', hash_file('crc32b', $filePath, true)));
    }
}
