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
    /**
     * Name of the package
     * @var string $name
     */
    public static $name = 'theme_simple';
    /**
     * Version of the package
     * @var int $version
     */
    public static $version = 0.1;
    /**
     * If the hooks are active set 'true'
     * else set an array with active hooks
     * the other ones won't be used
     * @var bool/array
     */
    public static $hooks = true;

    /**
     * Load the theme file
     */
    public static function theme() {
        packages::call('themeMenu', array(array('top'), &$themeMenus));
        // now include the theme file
        $tpl = new Template('packages/theme_simple/theme/main.php');

        $tpl->Set($themeMenus);

        echo $tpl->parse();
    }
}
?>