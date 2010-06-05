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
     * Parse a .ini file with or without groups
     *
     * @param  string $file
     * @param  string $option
     * @return array
     */
    public static function read($file, $option='false')
    {
        if($option == true)
            $data = parse_ini_file($file, true);
        else
            $data = parse_ini_file($file);
        return $data;
    }

    /**
     * Write given array to ini file
     *
     * @param   string   $file
     * @return  array    $content
     */
    public static function write($file, $content)
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

    /**
     * Change a value in a .ini file
     *
     * @param string $file
     * @param string $item
     * @param string $value
     * @param string $group
     */
    public static function change($file, $item, $value, $group)
    {
        // at first parse the file
        if($group != false)
        {
            $data = self::read($file);
            $data[$item] = $value;
        } else {
            $data = self::read($file, true);
            $data[$group][$item] = $value;
        }

        // now write back
        return self::write($file, $data);
    }
}
?>
