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
        $this->views_dir = realpath(__DIR__ . '../..' . 'views') . DIRECTORY_SEPARATOR;
    }

    public function render($filename, $vars = array())
    {
        $filepath = $this->views_dir . $filename . self::$views_ext;
        if (!file_exists($filepath)) {
            throw new ViewException();
        }
        ob_start();
        extract($vars);
        include $filepath;
        return ob_get_contents();
    }
}
