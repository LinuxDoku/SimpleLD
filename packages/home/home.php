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
     * Enabled Controllers
     * @var array
     */
    public static $controller = array('default' => array('controller_home' => 0),
                                      'home' => array('controller_home' => 0));

    /**
     * Display the home page
     */
    public static function controller_home()
    {
        // display theme header
        packages::call('themeHeader');
        // load page template
        $tpl = new Template('packages/home/templates/home.php');
        // add new template vars
        packages::call('homeTemplateVars', &$vars);
        $tpl->Set($vars);
        // display template
        echo $tpl->parse();
        // display theme footer
        packages::call('themeFooter');
    }
}
?>