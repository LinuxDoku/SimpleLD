<?php
/**
 * URL is a core class of SimpleLD it handels all
 * things which have to do with url.
 *
 * @package  core
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */
class url {
    /**
     * Stores the url in parts for the request method
     * @var array
     */
    private static $urlParts = array();

    /**
     * Get the complete url string
     * @return string
     */
    public static function get() {
        return $_GET['p'];
    }

    /**
     * Get a part of the url as string
     *  -1 | The complete url
     *   0 | The first part
     *   n | any other part
     *
     * @param  int  $part
     * @return string
     */
    public static function request($part) {
        // if the array is empty fill it
        if(count(self::$urlParts) == 0)
            self::$urlParts = explode('/', $_GET['p']);
        // then return the requested data
        return self::$urlParts[$part];
    }

    /**
     * Redirects to the given page (only use it before
     * any output, else it will give an fatal error!)
     * @param string $url
     */
    public static function location($url) {
        Header('location: '.$url);
    }

    /**
     * Redirect to the destionation page which is given
     * via a GET param
     */
    public static function destination() {
        if($_GET['destination'])
            self::location('?p='.$_GET['destination']);
    }
}
?>
