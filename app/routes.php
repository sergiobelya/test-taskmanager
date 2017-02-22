<?php

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'TasksController::index');
//    $r->addRoute('GET', '/users', 'get_all_users_handler');
    // {id} must be a number (\d+)
//    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
    // The /{title} suffix is optional
//    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
//    $r->addRoute('GET', '/{controller:\w+}[/{action:\w+}]', 'Controller_Action');
//    $r->addRoute('GET', '/admin/[{controller:\w+}/{action:\w+}]', 'Admin_Controller_Action');
});
