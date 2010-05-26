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
    public static $name = 'home';
    /**
     * Version of the package
     * @var int
     */
    public static $version = 0.1;
    /**
     * Hooks enabled
     * @var bool/array
     */
    public static $hooks = true;

    /**
     * Give the home page content
     */
    public static function pageContent()
    {
        if(url::request(0) == 'home')
        {
            $tpl = new Template('packages/home/templates/home.php');

            packages::call('homeTemplateVars', &$vars);
            $tpl->Set($vars);

            echo $tpl->parse();
        }
    }
}
?>