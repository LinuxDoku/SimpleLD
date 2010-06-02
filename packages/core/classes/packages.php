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
    /**
     * All loaded packages with their hooks
     * @var  array
     */
    public static $packages = array();
    
    /**
     * If cache is active or inactive
     * @var  bool
     */
    public static $cacheState = false;

    /**
     * Handle the url part give true if:
     *   - the url is empty
     *   - the url is the same as the request
     *   - the url is the beginn of the request ends with a *
     *
     * @param  string  $url
     */
    private static function handleUrl($url)
    {
        $return = false;
        if($url != '' && $_GET['p'] != '')
        {
            if(substr($url, -1, 1) == '*')
            {
                $url = str_replace('*', '', $url);
                $len = strlen($url);
                if(substr($_GET['p'], 0, $len) == $url)
                {
                    $return = true;
                }
            } elseif($url == trim($_GET['p'])) {
                $return = true;
            }
        } elseif($url == '') {
            $return = true;
        }
        return $return;
    }

    /**
     * Load package and put name and events into packagess array
     *
     * @param   string   $object
     * @return  boolean
     */
    public static function load($object)
    {
        $objectName = get_class($object);
        if($objectName::$hooks === true)
        {
            $methods = get_class_methods($objectName);
            foreach($methods as $method)
            {
                if($method{0} != '_')
                {
                    self::$packages[$method][$objectName] = '';
                }
            }
         } elseif(is_array($objectName::$hooks)) {
             foreach($objectName::$hooks as $method => $url)
             {
                if($method{0} != '_' && self::$cacheState == true)
                {
                    self::$packages[$method][$objectName] = $url;
                } elseif($method{0} != '_') {
                    // load only hooks which are similar to the url
                    if(self::handleUrl($url))
                    {
                        self::$packages[$method][$objectName] = $url;
                    }
                }
             }
         }
    }

    /**
     * Trigger events, this method checks the packages array and calls them
     * if the first part of the url is similar to the given
     *
     * @param  string  $event
     * @param  array   $param
     */
    public static function call($event, $param='')
    {
        if(count(self::$packages[$event]) != 0)
        {
            foreach(self::$packages[$event] as $name => $url)
            {
                if(self::handleUrl($url))
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
    }

    /**
     * Check if a package is installed
     *
     * @param  string  $name
     * @return bool
     */
    public static function check($name)
    {
        if(file_exists("packages/$name/$name.php"))
  	{
  		return true;
  	} else {
  		return false;
  	}
    }

    /**
     * Read the cache file if it exists
     *
     * @return bool
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
     * @return bool
     */
    public static function writeCache()
    {
        // write to cache file
        ini::write('includes/packages_cache.php', self::$packages);
        return true;
    }
}
?>
