<?php
/**
 * This is the core package
 *
 * @package  core
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */
class core extends package
{
    public static $name = 'core';
    public static $version = 0.1;
    public static $hooks = true;

    /**
     * Include all core classes which are not alleready
     * loaded in the init.php
     */
    public static function indexInclude() {
        foreach(self::getConf('core', 'classes') as $name)
        {
            self::loadClass($name, 'core');
        }
    }

    /**
     * Redirect to the destionation page, for example after
     * login to the page where the login form was.
     */
    public static function indexAfterActions() {
        if(self::checkClass('url', 'core'))
                url::destination();
    }
}

?>
