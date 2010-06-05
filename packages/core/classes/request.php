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
            return $_POST[$name];
        } else {
            return $_POST;
        }
    }
}
?>
