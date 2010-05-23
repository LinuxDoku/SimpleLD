<?php
/**
 * This is the package system
 *
 * @package  core
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */

class packages
{
    public static $packages = array();
    /**
     * load module and put name and events into packagess array
     *
     * @param   string   object
     * @return  boolean
     */
    public static function load($object)
    {
        $name = get_class($object);
        if(!is_array($name::$hooks))
        {
            $methods = get_class_methods($name);
            foreach($methods as $method)
            {
                if($method{0} != '_')
                {
                    self::$packages[$method][$name] = 1;
                }
            }
         } else {
             foreach($object::$hooks as $method)
             {
                if($method{0} != '_')
                {
                    self::$packages[$method][$name] = 1;
                }
             }
         }
    }


    /**
     * trigger events, this method checks the packages array and calls them
     *
     * @param  string  event
     */
    public static function call($event, $param='')
    {
        if(self::$packages[$event] != "")
        {
            foreach(self::$packages[$event] as $name => $active)
            {
                if(!is_array($param))
                {
                    call_user_func(array($name, $event));
                } else {
                    call_user_func_array(array($name, $event), $param);
                }
            }
        }
    }

    /**
     * check if a package is installed
     *
     * @param  string  name
     * @return boolean
     */
    public static function check($name)
    {
        if(file_exists("packages/$name/$name.php") == true)
  	{
  		return true;
  	} else {
  		return false;
  	}
    }

    /**
     * Read the cache file if it exists
     *
     * @return boolean
     */
    public static function readCache()
    {
        // check if cache is actual and then parse it
        if(file_exists('includes/packages_cache.php'))
        {
            self::$packages = parse_ini_file('includes/packages_cache.php', true);
        }
        // check if any hooks are registered
        if(count(self::$packages) == 0)
        {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Write all packages and hooks to cache file
     *
     * @param  array   $array
     * @return boolean
     */
    public static function writeCache()
    {
        // write to cache file
        package::_ini_write('includes/packages_cache.php', self::$packages);
        return true;
    }
}
?>
