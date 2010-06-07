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
     * All loaded Hooks
     * @var  array
     */
    public static $hooks = array();

    /**
     * All loaded Controllers
     * @var  array
     */
    public static $controller = array();
    
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
     */
    public static function load($name)
    {
        if(!self::$cacheState && file_exists('packages/'.$name.'/'.$name.'.php'))
        {
            require_once('packages/'.$name.'/'.$name.'.php');
            $object = new $name;
            $objectName = get_class($object);
            // register package
            self::$packages[$objectName] = true;
            // load hooks
            if(is_array($objectName::$hooks)) {
                 foreach($objectName::$hooks as $method => $url)
                 {
                    if($method{0} != '_' && self::$cacheState == true)
                    {
                        self::$hooks[$method][$objectName] = $url;
                    } elseif($method{0} != '_') {
                        // load only hooks which are similar to the url
                        if(self::handleUrl($url))
                        {
                            self::$hooks[$method][$objectName] = $url;
                        }
                    }
                 }
             }
             // load controllers
             if(isset($objectName::$controller))
             {
                if(is_array($objectName::$controller))
                {
                    foreach($objectName::$controller as $name => $infos)
                    {
                        self::$controller[$objectName][$name] = $infos;
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
        if(count(self::$hooks[$event]) != 0)
        {
            foreach(self::$hooks[$event] as $name => $url)
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

    public static function callController($request)
    {
        $request = trim($request);
        $params = explode('/', $request);
        // put params to vars
        $package = $params[0];
        $controller = $params[1];
        // check if a controller is given else load default
        if(!isset($controller))
        {
            $controller = 'default';
            $params[1] = 'default';
        }
        // now look if a controller exists
        if(!isset(self::$controller[$package][$controller]))
        {
            $controller = 'default';
            $params[1] = 'default';
        }
        // now call the controller
        if(self::$controller[$package][$controller])
        {
            foreach(self::$controller[$package][$controller] as $methodName => $controllerParams)
            {
                if((count($params) - 2) == $controllerParams)
                {
                    // now decide which function we use and call the controller
                    if($controllerParams == 0)
                    {
                        call_user_func(array($package, $methodName));
                    } else {
                        // remove the package and the controller from the params
                        array_shift($params);
                        array_shift($params);
                        call_user_func_array(array($package, $methodName), $params);
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
        if(file_exists('includes/hook_cache.php'))
        {
            self::$hooks = parse_ini_file('includes/hook_cache.php', true);
        }
        // check if any hooks are registered
        if(count(self::$hooks) == 0)
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
        ini::write('includes/hook_cache.php', self::$hooks);
        return true;
    }
}
?>
