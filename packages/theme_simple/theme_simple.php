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
     * Hooks active?
     * @var bool/array
     */
    public static $hooks = array('theme' => '');

    /**
     * Load the theme file
     */
    public static function theme() {
        // call packages to add new vars to the theme
        packages::call('themeMenus', array(array('top'), &$themeMenus));
        packages::call('themeVars', array(&$themeVars));
        // now include the theme file
        $tpl = new Template('packages/theme_simple/theme/main.php');

        $tpl->Set($themeMenus);
        $tpl->Set($themeVars);

        echo $tpl->parse();
    }
}
?>