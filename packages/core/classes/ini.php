<?php
/**
 * ini file functions
 *
 * @package  core
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */
class ini {
    /**
     * Write given array to ini file
     *
     * @param   string   $file
     * @return  array    $content
     */
    static function write($file, $content)
    {
        if(is_writeable($file) == true)
        {
            $c = ";<?php die() ?>\n";
            foreach($content as $item1 => $item2)
            {
                $c = $c."[".$item1."]\n";
                foreach($item2 as $item3 => $item4)
                {
                    $c = $c.$item3." = ".$item4."\n";
                }
            }
            $handle = fopen($file, 'w');
            if(fwrite($handle, $c))
            {
                return true;
            } else {
                return false;
            }
        }
    }
}
?>
