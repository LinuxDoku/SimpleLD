<?php
/**
 * This package displays a home page
 *
 * @package  home
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */

class home extends package {
    public static $name = 'home';
    public static $version = 0.1;
    public static $hooks = true;

    public static function pageContent()
    {
        if(self::_request(0) == 'home')
        {
            echo "This is a demo home page<br>";
        }
    }
}
?>