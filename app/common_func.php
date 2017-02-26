<?php
use sergiobelya\TestTaskmanager\lib\Exceptions\Http404Exception;

function docRoot()
{
    return filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
}

function appPath()
{
    return __DIR__ . DIRECTORY_SEPARATOR;
}

if (!function_exists('e')) {
    function e($str)
    {
        return htmlentities($str, ENT_QUOTES, 'UTF-8', false);
    }
}

function uri($uri)
{
    return '/' . trim($uri, '/');
}

function uriStatic($url)
{
    $path = realpath(docRoot() . $url);
    $uri = uri($url);
    if (!$path) {
        return $uri;
    }
    return $uri .= '?' . filemtime($path);
}

function error404($msg = '')
{
    throw new Http404Exception($msg);
}

function fatalExceptionHandler(Exception $e)
{
    header('HTTP/1.1 500 Server Error');
    if ('development' == getenv('APP_ENV')) {
        echo '<pre>';
        echo '<b>Fatal error</b>:  Uncaught exception ' . get_class($e) . PHP_EOL;
        if ($msg = $e->getMessage()) {
            echo 'with message ' . $msg . PHP_EOL;
        }
        echo 'in ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
        echo 'Stack trace:' . PHP_EOL;
        echo $e->getTraceAsString();
        echo '</pre>';
    } else {
        die('Unknown server error');
    }
}
