<?php
/**
 * Load a template and parse it
 *
 * @package  core
 * @author   Martin Lantzsch
 * @mail     martin@linux-doku.de
 * @licence  GPL
 */
class Template
{

  private $bound = array();
  private $file;

    public function __construct($tplName)
    {
        // set the template name for loading
        $this->file = $tplName;
    }
    
    public function Set($name, $value = NULL)
    {
        // Bind associative array
        if(is_array($name))
        {
            foreach($name as $key => $value)
            {
                $this->bound[$key] = $value;
            }
        } else {
            // If instance of self then save as reference
            if($value instanceof self)
            {
                $this->bound[$name] = &$value;
            } else {
                $this->bound[$name] = $value;
            }
        }
    }
    
    public function parse()
    {
        // Parse templates and bind to variables
        foreach($this->bound as $key => $value)
        {
            if($value instanceof self)
            {
                $value = $value->parse();
            }
            $$key = $value;
        }
        
        // Start outputbuffering
        ob_start();
        // Include template
        if(file_exists($this->file))
        {
            require($this->file);
        } else {
            return false;
        }
        // Stop buffering and get its contents
        return ob_get_clean();
    }
}
?>