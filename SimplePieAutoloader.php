<?php
// autoloader
spl_autoload_register(array(new SimplePie_Autoloader, 'autoload'));

class SimplePie_Autoloader
{
    public function __construct()
    {
        $this->path = dirname(__FILE__);
    }
    public function autoload($class)
    {
        // see if this request should be handled by this autoloader
        if (strpos($class, 'SimplePie') !== 0) {
            return;
        }

        $filename = $this->path . DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
        include $filename;
    }
}