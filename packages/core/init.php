<?php
/**
 * This file loads the config file, connects to the database
 * (if the connection details are filled in the config file)
 * and it loads all packages from the packages directory.
 *
 * @package  core
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */

// load classes
require('packages/core/classes/db.php');
require('packages/core/classes/packages.php');
require('packages/core/classes/package.php');
require('packages/core/classes/template.php');
require('packages/core/classes/ini.php');

// load config file
$config = parse_ini_file('includes/config.php', true);

// connect with database
if($config['core']['db_host'] != '')
{
  $db = new db();
  $db->connect($config['core']['db_host'], $config['core']['db_user'], $config['core']['db_password'], $config['core']['db_database']);
}
// define install number as NR
define("NR", $config['core']['install_number']);
// make an object of the db class

// get all packages
// get packages from cache if cache is actual
if(!packages::readCache() && !$config['packages_cache'])
{
    $cache = false;
} elseif($config['packages_cache']) {
    $cache = true;
}

// say the packages system if the cache is on or off
packages::$cacheState = $cache;

// NOTE: This step could also work with a database
$dir = scandir('packages/');
foreach($dir as $name)
{
    if(file_exists("packages/$name/$name.php"))
    {
        packages::load($name);
        // load language file if existing
        if(file_exists("packages/$name/lang/".$config['core']['lang'].".php"))
        {
            $lang[$name] = ini::read("packages/$name/lang/".$config['core']['lang'].".php", false);
        }
    }
}

// now generate new cache file
if($cache == false)
{
    packages::writeCache();
    packages::call('coreInitWriteCache');
}
?>
