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
