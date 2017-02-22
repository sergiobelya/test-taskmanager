<?php

namespace sergiobelya\TestTaskmanager\lib;

use Exception;

/**
 * @author Serg
 */
class Request
{
    protected $controller_ns = 'sergiobelya\\TestTaskmanager\\Controllers';

    protected $controller;

    protected $action;

    protected $route_params = array();

    public function setRouteParams($params)
    {
        $this->route_params += $params;
    }

    public function routeParam($name, $default = null)
    {
        if (isset($this->route_params[$name])) {
            return $this->route_params[$name];
        } else {
            return $default;
        }
    }

    public function setController($controller_name)
    {
        $this->controller = $controller_name;
    }

    public function setAction($action_name)
    {
        $this->action = $action_name;
    }

    public function exec()
    {
        if (!$this->controller || !$this->action) {
            throw new Exception('Controller and action must be set');
        }
        $full_controller_name = $this->controller_ns . '\\' . $this->controller;
        if (!class_exists($full_controller_name)) {
            // TODO: 404
            throw new Exception("Controller {$full_controller_name} is not exists");
        }
        $controller = new $full_controller_name($this);
        if (!method_exists($controller, $this->action)) {
            // TODO: 404
            throw new Exception("Method {$full_controller_name}::{$this->action} is not exists");
        }
        $content = $controller->{$this->action}();
        $response = new Response();
        $response->setBody($content);
        return $response;
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}
