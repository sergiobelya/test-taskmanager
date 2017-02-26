<?php

use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;


// Init Dotenv
$dotenv = new Dotenv(__DIR__ . '/../');
$dotenv->load();


// Init Eloquent ORM
$config_db = include 'config/database.php';
$cnf_mysql = $config_db['connections']['mysql'];
$capsule = new Capsule;
$capsule->addConnection($cnf_mysql);
// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();
// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
