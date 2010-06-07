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
    public static $hooks = array('themeHeader' => '',
                                 'themeFooter' => '');

    /**
     * Load the theme file
     */
    public static function themeHeader() {
        // call packages to add new vars to the theme
        packages::call('themeMenus', array(array('top'), &$themeMenus));
        packages::call('themeVars', array(&$themeVars));
        // now the theme file
        $tpl = new Template('packages/theme_simple/theme/themeHeader.php');

        $tpl->Set($themeMenus);
        $tpl->Set($themeVars);

        echo $tpl->parse();
    }

    public static function themeFooter() {
        packages::call('themeVars', array(&$themeVars));
        // now the theme files
        $tpl = new Template('packages/theme_simple/theme/themeFooter.php');

        $tpl->Set($themeVars);

        echo $tpl->parse();
    }
}
?>