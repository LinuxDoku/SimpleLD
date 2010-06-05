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
    /**
     * Name of the package
     * @var string
     */
    public static $name = 'home*';
    /**
     * Version of the package
     * @var int
     */
    public static $version = 0.1;
    /**
     * Hooks enabled
     * @var bool/array
     */
    public static $hooks = array('pageContent' => 'home');

    public static $controller = array('default' => array('controller_test' => 0),
                                      'test' => array('controller_test' => 0));

    /**
     * Give the home page content
     */
    public static function controller_test()
    {
        packages::call('themeHeader');
        $tpl = new Template('packages/home/templates/home.php');

        packages::call('homeTemplateVars', &$vars);
        $tpl->Set($vars);

        echo $tpl->parse();
        packages::call('themeFooter');
    }
}
?>