<?php
/**
 * With the package manager you can manage all your
 * packages. You can install, update and uninstall
 * your packages.
 *
 * @package  package_manager
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */
class package_manager extends package {
    /**
     * Name of the package
     * @var string
     */
    public static $name = 'package_manager';

    /**
     * Version of the package
     * @var int
     */
    public static $version = 0.1;

    /**
     * Enabled hooks
     * @var bool/array
     */
    public static $hooks = array('indexActions' => 'acp/package_manager/install/*');

    /**
     * This triggers a URL and calls the installer
     */
    public static function indexActions()
    {
        if(preg_match('/acp\/package_manager\/install\/([a-zA-Z0-9_-])*/', url::get()))
        {
            self::_install_package(url::request('3'));
        }
    }
    /**
     * Install a package from tmp
     *
     * @param  string  $name
     * @return bool
     */
    public static function _install_package($name)
    {
        // check if package file is existing
        if(file_exists('packages/tmp/'.$name.'.zip'))
        {
            include('packages/package_manager/classes/pclzip.class.php');
            // now extract it
            $pclzip = new PclZip('packages/tmp/'.$name.'.zip');
            $pclzip->extract(PCLZIP_OPT_PATH, 'packages/');
        }
        // now check versions
        if(file_exists('packages/'.$name.'/'.$name.'.php'))
        {
            include('packages/'.$name.'/'.$name.'.php');
            $old = $name::$version;
        } else {
            $old = 0;
        }
        // if a setup file exists open it
        if(file_exists('packages/'.$name.'/setup.php'))
        {
            $setup = parse_ini_file('packages/'.$name.'/setup.php', true);
            // check if new version is higher than the old one
            if($old < $setup['info']['version'])
            {
                // run all mysql querys
                foreach($setup as $version)
                {
                    if($version != 'info' && $old < $version)
                    {
                        // run sql querys
                        foreach($version['db'] as $query)
                        {
                            db::query(str_replace('NR_', NR, $query));
                        }
                        // set config params
                        foreach($version['config'] as $cfg)
                        {
                            explode('||', $cfg);
                            self::_setConf($name, $cfg[0], $cfg[1]);
                        }
                        // a hook for new packages
                        packages::call('package_manager_install', $version);
                    }
                }
            }
        }
    }
}
?>
