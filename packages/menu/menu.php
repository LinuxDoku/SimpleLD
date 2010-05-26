<?php
/**
 * The menu package provides a menu system for themes
 *
 * @package  menu
 * @author   Martin lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */
class menu extends package {
    /**
     * Name of the package
     * @var string
     */
    public static $name = 'menu';
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
     * Give it an array of all it's menus and this package
     * looks in the database for these menus and puts all
     * items to a template, which will be given back to
     * the theme.
     * 
     * @param array $menus
     * @param array $themeMenus
     */
    public static function themeMenu($menus, &$themeMenus) {
        foreach($menus as $name)
        {
            // start new theme
            $tpl = new Template('packages/menu/templates/menuItems.php');
            // now get all menu items
            $menuItems = array();
            $query = db::query('SELECT name, link, alt FROM '.NR.'_menu WHERE menu = "'.$name.'" ORDER by sort ASC');
            while($item = db::fetch_array($query))
            {
                $menuItems[]['name'] = $item['name'];
                $menuItems[]['link'] = $item['link'];
                $menuItems[]['alt'] = $item['alt'];
                $menuItems[]['params'] = $item['params'];
            }
            // assign all menu points to the theme
            $tpl->Set('menuItems', $menuItems);
            // then we put the parsed theme into an array
            $themeMenus[$name] = $tpl->parse();
        }
    }
}
?>
