<?php

function docRoot()
{
    return filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
}

function appPath()
{
    return __DIR__ . DIRECTORY_SEPARATOR;
}
