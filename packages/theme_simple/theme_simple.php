<?php
/**
 * Description of package_manager
 *
 * @package  package_manager
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