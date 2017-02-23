<?php

return [

    'fetch' => PDO::FETCH_CLASS,

    'default' => 'mysql',

    'connections' => [

        'mysql' => [
            'driver'    => 'mysql',
            'host'      => getenv('DB_HOST') ?: 'localhost',
            'database'  => getenv('DB_DATABASE'),
            'username'  => getenv('DB_USERNAME'),
            'password'  => getenv('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => '',
            'strict'    => false,
        ],

    ],

];
