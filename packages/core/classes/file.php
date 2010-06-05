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
     * Read a file with any content
     *
     * @param  string  $file
     * @return string
     */
    public static function read($file)
    {
        return file_get_contents($file);
    }

    /**
     * If you don't give any content it will make the file empty
     *
     * @param  sting  $file
     * @param  string  $content
     * @return bool
     */
    public static function write($file, $content='')
    {
        return file_put_contents($file, $content);
    }

    /**
     * Deletes a file or folder with all subfiles
     * and folders.
     *
     * @param  string  dir
     * @return boolean
     */
    public static function delete($dir)
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

    public static function createFolder($dir)
    {
        return mkdir($dir);
    }
}
?>
