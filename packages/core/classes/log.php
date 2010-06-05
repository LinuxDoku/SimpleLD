<?php
/**
 * To log debug messages or errors
 *
 * @package  core
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */
class log {
    /**
     * All logs will be saved in this var
     * @var array
     */
    private static $log = array();
    
    /**
     * Add a message to log
     *
     * @param  string  $package
     * @param  string  $type
     * @param  string  $message
     * @return bool
     */
    static function add($package, $info, $type, $message)
    {
        // now we add a new item to the package log
        self::$log[$package][] = array($type, array($info, $message));
        return $message;
    }

    /**
     * Read all log entrys for a specific package and for
     * any type you want.
     *
     * @param  string $package
     * @param  string $type
     * @return array
     */
    static function read($package, $type='') {
        $tmp = array();
        // go through all log entrys
        foreach(self::$log[$package] as $logType => $logMessage)
        {
            // write it if the type is ok
            if($logType == $type)
            {
                $tmp[] = $logMessage;
            } elseif($type == '') {
                $tmp[] = $logMessage;
            }
        }
        return $tmp;
    }
}
?>
