<?php

class App {

    protected $env;

    protected $theme;

    protected $routes;

    /**
     * App constructor
     * @param string $env
     */
    public function __construct($env = 'dev') {
        // Init asubit microframework app
        $this->env = $env;
        $this->routes = [];
    }

    /**
     * Init asubit microframework app
     * and load enabled libraries
     * @param array $libs
     */
    public function run($libs = null) {
        // Apply debug
        switch ($this->env) {
            case 'dev':
                $this->enableDebug();
                break;
            default:
                break;
        }
        // Load App routes
        $routes = json_decode(file_get_contents(__DIR__ . '/config/routing.json'), true);
        // Load libraries
        if ($libs) {
            foreach ($libs as $id => $lib) {
                $this->load($lib);
                $libRoutes = json_decode(file_get_contents(__DIR__ .'/lib/'.$lib.'/routing.json'), true);
                $routes = array_merge($routes, $libRoutes);
            }
        }
        $this->routes = json_encode($routes);
    }

    /**
     * Load a library in App
     * @param $lib
     */
    public function load($lib) {
        try {
            // Is there a lib ?
            if ($lib) {
                // Is it installed ?
                if ($this->isLibInstalled($lib)) {
                    // Let's load it !
                    include(__DIR__ .'/lib/'.$lib.'/'.$lib.'.php');
                } else {
                    throw new Exception('Library ' . $lib . ' is not installed.');
                }
            } else {
                throw new Exception('No library to load.');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Execute controller for the current URL
     * based on all routing.json files in App/lib
     */
    public function route() {
        $routes = json_decode($this->routes);
        $path = $this->getPath();

        if (isset($routes->$path->controller)) {
            include $routes->$path->controller;
        } else {
            include 'Controller/ErrorController.php';
        }
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
        return $path ? $path : '/';
    }

    /**
     * Check if a library is installed
     */
    public function isLibInstalled($lib) {
        return in_array($lib, $this->getLibs());
    }

    /**
     * Get libraries list
     */
    public function getLibs() {
        return array_diff(scandir(__DIR__ .'/lib'), array('.', '..'));
    }
    
    /**
     * Enable debug functions on App::run()
     */
    public function enableDebug() {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        echo $this->debugBar();
    }

    /**
     * HTML added if env is dev
     */
    public function debugBar() {
        // Internal style sheet
        $style = '<style>
        .debugbar{
            position:fixed;
            bottom:0px;
            width:100%;
            background:black;
            color:white;
            height:3em;
            line-height:3em;
            vertical-align:middle;
        }
        .debugbar div {
            float: left;
            text-align: center;
            border-right: white solid 1px;
            padding: 0 1em;
        }
        </style>';
        // HTTP response status
        $color = 'black';
        switch(http_response_code()) {
            case '200':
                $color = '#2ed15e';
                break;
            case '404':
                $color = '#ff9b19';
                break;
            case '500':
                $color = '#ff0000';
                break;
        }
        // Current URL
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        // Construct HTML
        $html = $style;
        $html .= '<div class="debugbar">';
        $html .= '<div>' . $this->env . '</div>';
        $html .= '<div>' . $_SERVER['REQUEST_METHOD'] . ' ' . $url . '</div>';
        $html .= '<div style="background-color: '.$color.'">HTTP ' . http_response_code() . '</div>';
        $html .= '<div>Libraries: ' . implode(', ', $this->getLibs()) . '</div>';
        $html .= '</div>';
        return $html;
    }
}
