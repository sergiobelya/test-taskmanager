<?php

namespace sergiobelya\TestTaskmanager\lib\Exceptions;

use Exception;
use sergiobelya\TestTaskmanager\Controllers\ErrorController;
use sergiobelya\TestTaskmanager\lib\Request;

/**
 * @author Serg
 */
class Http404Exception extends Exception
{
    public function __construct($message = "")
    {
        header('HTTP/1.1 404 Not Found');
        $controller = new ErrorController(new Request()); // TODO: fixme
        echo $controller->error404($message);
        die(); // TODO: fixme
    }
}
