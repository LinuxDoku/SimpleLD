<?php
/**
 * This is a simple theme for demonstrate the
 * theme features.
 *
 * @package  theme_simple
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */
class theme_simple extends package {
    public static $name = 'theme_simple';
    public static $version = 0.1;
    public static $hooks = true;

    public static function theme() {
        // now include the theme file
        include('packages/theme_simple/theme/main.php');
    }
}
?>