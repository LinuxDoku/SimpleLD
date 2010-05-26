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
    public static $blackHooks = array('checkClaas', 'error', 'getConf', 'lang', 'loadClaas', 'message', 'rmConf', 'setConf');
    
    /**
     * All loaded classes
     * @var array
     */
    private static $loadedClasses = array();

    /**
     * Load a class from the given package class dir.
     *
     * @param  string $name
     * @param  string $package
     * @return object/bool
     */
    public static function loadClass($name, $package='core') {
        if(file_exists('packages/'.$package.'/classes/'.$name.'.php'))
        {
            include_once('packages/'.$package.'/classes/'.$name.'.php');
            self::$loadedClasses[$name] = $package;
            return new $name;
        } else {
            return false;
        }
    }

    public static function checkClass($name, $package='core') {
        $availible = false;
        if(count(self::$loadedClasses[$name]) != 0)
        {
            $availible = true;
        }
        return $availible;
    }

    /**
     * Get a config param
     *
     * @param  string $section
     * @param  string $option
     * @return string
     */
    public static function getConf($section, $option)
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
    public static function setConf($group, $item, $value, $file='includes/config.php')
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
    public static function rmConf($group, $item = '', $file='includes/config.php')
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
    public static function message($message)
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
    public static function error($message)
    {
        $_SESSION['error'] = $_SESSION['error']."<br>".$message;
        return true;
    }

    /**
     * Get a lang string
     *
     * @param  string $section
     * @param  string $option
     * @return string
     */
    public static function lang($section, $option)
    {
        global $lang;
        return $lang[$section][$option];
    }
}
?>
