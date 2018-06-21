<?php

class Routing {

    /**
     * Constructor
     */
    public function __construct() {

    }

    /**
     * Get current path
     */
    public function getPath() {
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $script_name = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
        $parts = array_diff_assoc($request_uri, $script_name);
        if (empty($parts))
        {
            return '/';
        }
        $path = implode('/', $parts);
        if (($position = strpos($path, '?')) !== FALSE)
        {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    /**
     * Execute controller for the current path
     */
    public function go() {
        $routes = json_decode(file_get_contents(__DIR__ . '/config/routing.json'));
        $path = $this->getPath();

        if (isset($routes->$path->controller)) {
            include $routes->$path->controller;
        } else {
            http_response_code(404);
            include 'views/404.php';
            die();
        }
    }
}