<?php
/**
 * File and directory functions
 *
 * @package  core
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */
class file {
    /**
     * Deletes a file or folder with all subfiles
     * and folders.
     *
     * @param  string  dir
     * @return boolean
     */
    static function delete($dir)
    {
        if(is_file($dir))
        {
            return @unlink($dir);
        } elseif(is_dir($dir)) {
            $scan = glob(rtrim($dir,'/').'/*');
            foreach($scan as $index=>$path) {
                self::deleteDir($path);
            }
            return @rmdir($dir);
        }
    }
}
?>
