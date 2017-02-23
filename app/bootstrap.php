<?php

use sergiobelya\TestTaskmanager\lib\Request;

include 'common_func.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

$config_db = include 'config/database.php';
$cnf_mysql = $config_db['connections']['mysql'];
/*
ActiveRecord\Config::initialize(function($cfg) use ($cnf_mysql) {
    $cfg->set_connections(
            array(
                'mysql' => "mysql://{$cnf_mysql['username']}:{$cnf_mysql['password']}@{$cnf_mysql['host']}/{$cnf_mysql['database']}",
            )
    );
    $cfg->set_default_connection('mysql');
});
*/
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection($cnf_mysql);
// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();
// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$request = new Request();

// Dispatch URI
include 'routes.php';
// Fetch method and URI from somewhere
$http_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
$uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
$route_info = $dispatcher->dispatch($http_method, $uri);
switch ($route_info[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        header('HTTP/1.1 404 Not Found');
        echo 'NOT FOUND';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // ... 405 Method Not Allowed
        $allowed_methods = $route_info[1];
        header('HTTP/1.1 405 Method Not Allowed');
        header("Allow: $allowed_methods");
        echo 'METHOD NOT ALLOWED';
        break;
    case FastRoute\Dispatcher::FOUND:
        // ... call $handler with $vars
        $handler = $route_info[1];
        $vars = $route_info[2];
        if ($pos_action_delim = strpos($handler, '::')) {
            $controller_name = substr($handler, 0, $pos_action_delim);
            $action = substr($handler, $pos_action_delim + 2);
            $request->setRouteParams($vars);
            $request->setController($controller_name);
            $request->setAction($action);
            $response = $request->exec();
            echo $response->sendHeaders()->getBody();
        } else {
            throw new Exception('handler format - FooController::bar');
        }
        break;
}
