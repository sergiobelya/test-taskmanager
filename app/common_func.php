<?php

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
