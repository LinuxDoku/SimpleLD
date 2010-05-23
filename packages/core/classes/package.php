<?php
/**
 * This class provides all needed functions for the packages
 *
 * @package  core
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */

class package
{
    /**
     * Add a message to log
     *
     * @param  string  $package
     * @param  string  $type
     * @param  string  $message
     * @return boolean
     */
    static function _log($package, $type, $message)
    {
        global $log;
        // now we add a new item to the package log
        $log[$package][] = array($type, $message);
        return true;
    }

    /**
     * Get a config param
     *
     * @param  string $section
     * @param  string $option
     * @return string
     */
    static function _getConf($section, $option)
    {
        global $config;
        return $config[$section][$option];
    }

    /**
     * writes a change to the config/another file
     *
     * @param  string  group
     * @param  string  item
     * @param  string  value
     * @param  string  file
     * @return boolean
     */
    static function _setConf($group, $item, $value, $file='includes/config.php')
    {
        global $vars;
        $vars[$pkg][$option] = $value;
        self::_ini_write($file, $vars);
        return true;
    }


    /**
     * removes a option/group from a config/another file
     *
     * @param  string  group
     * @param  string  item
     * @param  string  file
     * @return boolean
     */
    static function _rmConf($group, $item = '', $file='includes/config.php')
    {
        global $config;
        if($file != 'includes/config.php')
        {
            // if file is not config file read the given
            $vars = parse_ini_file($file);
        } else {
            // else set config file
            $vars = $conf;
        }
        if($item != '')
        {
            // if a itemis given
            unset($config[$pkg][$option]);
        } else {
            // if no item is given
            unset($config[$pkg]);
        }
        // write it to file
        self::_ini_write('includes/config.php', $config);
        return true;
    }

    /**
     * adds a message to queue which will be displayed in the theme
     *
     * @param  string  message
     * @return boolean
     */
    static function _Message($message)
    {
        $_SESSION['message'] = $_SESSION['message']."<br>".$message;
        return true;
    }

    /**
     * adds a error to queue which will be displayed in the theme
     *
     * @param  string  message
     * @return boolean
     */
    static function _Error($message)
    {
        $_SESSION['error'] = $_SESSION['error']."<br>".$message;
        return true;
    }

    /**
     * moves to a given page (use it only before any output!)
     *
     * @param  string  url
     */
    public static function _Move($url)
    {
        Header("Location: $url");
    }

    /**
     * Explode the page param and give the number
     *
     * @param  int $number
     * @return string
     */
    public static function _Request($number)
    {
        $get = explode('/', $_GET['p']);
        return $get[$number];
    }

    /**
     * deletes a folder with all subfiles and folders
     *
     * @param  string  dir
     * @return boolean
     */
    static function _deleteDir($dir)
    {
        if(is_file($dir))
        {
            return @unlink($dir);
        } elseif(is_dir($dir)) {
            $scan = glob(rtrim($dir,'/').'/*');
            foreach($scan as $index=>$path) {
                Package::deleteDir($path);
            }
            return @rmdir($dir);
        }
    }

    /**
     * Get a lang string
     *
     * @param  string $section
     * @param  string $option
     * @return string
     */
    static function _Lang($section, $option)
    {
        global $lang;
        return $lang[$section][$option];
    }

    /**
     * Write given array to ini file
     *
     * @param   string   $file
     * @return  array    $content
     */
    static function _ini_write($file, $content)
    {
        if(is_writeable($file) == true)
        {
            $c = ";<?php die() ?>\n";
            foreach($content as $item1 => $item2)
            {
                $c = $c."[".$item1."]\n";
                foreach($item2 as $item3 => $item4)
                {
                    $c = $c.$item3." = ".$item4."\n";
                }
            }
            $handle = fopen($file, 'w');
            if(fwrite($handle, $c))
            {
                return true;
            } else {
                return false;
            }
        }
    }
}

?>
