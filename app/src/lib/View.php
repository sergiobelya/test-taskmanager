<?php

namespace sergiobelya\TestTaskmanager\lib;

use sergiobelya\TestTaskmanager\lib\Exceptions\ViewException;

/**
 * @author Serg
 */
class View
{
    protected $views_dir;

    protected static $views_ext = '.php';

    public function __construct()
    {
        $this->views_dir = appPath() . 'views' . DIRECTORY_SEPARATOR;
    }

    public function render($filename, $vars = array())
    {
        $filepath = realpath($this->views_dir . $filename . self::$views_ext);
        if (!file_exists($filepath)) {
            throw new ViewException("Template $filename is not exists");
        }
        ob_start();
        extract($vars);
        include $filepath;
        return ob_get_clean();
    }
}
