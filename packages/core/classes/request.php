<?php
/**
 * Description of request
 *
 * @pacakge  core
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */
class request {

    public static function post($name=false)
    {
        if($name != false)
        {
            return $_GET[$name];
        } else {
            return $_GET;
        }
    }
}
?>
