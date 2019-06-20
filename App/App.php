<?php

/**
 * Asubit MicroFramework App
 * 
 * @author Antoine Subit
 * @copyright Antoine Subit © 2019
 * @license CeCILL-B [http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.html]
 */
class App {

    /**
     * @var string $env
     */
    protected $env;

    /**
     * @var Theme $theme
     */
    protected $theme;

    /**
     * @var array $routes
     */
    protected $routes;

    /**
     * App constructor
     * @param string $env
     */
    public function __construct($env = 'dev') {
        // app environment definition
        $this->env = $env;
        // app routes definition
        $this->routes = [];
    }

    /**
     * Loads the components specific to each environment
     * Loads the libraries from App/lib
     * Define all routes of the application and libraries
     * @param array $libs
     */
    public function run($libs = null) {
        // Session init
        session_start();
        // load env components
        switch ($this->env) {
            case 'dev':
                $this->enableDebug();
                break;
            default:
                break;
        }
        // load app routes
        $routes = json_decode(file_get_contents(__DIR__ . '/config/routing.json'), true);
        // load libraries
        if ($libs) {
            foreach ($libs as $id => $lib) {
                // execute library main loader file
                $this->load($lib);
                // load library routes
                $libRoutes = json_decode(file_get_contents(__DIR__ .'/lib/'.$lib.'/routing.json'), true);
                $routes = array_merge($routes, $libRoutes);
            }
        }
        // all app & Lib routes format
        $this->routes = json_encode($routes);
    }

    /**
     * Load a library in App
     * @param $lib
     */
    public function load($lib) {
        try {
            // is there a lib ?
            if ($lib) {
                // is it installed ?
                if ($this->isLibInstalled($lib)) {
                    // let's load it !
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
     * Execute Controller for the current URL
     */
    public function route() {
        // app routes
        $routes = json_decode($this->routes);
        // current path
        $path = $this->getPath();
        // check routes path controller match
        if (isset($routes->$path->controller)) {
            // execute controller
            include $routes->$path->controller;
        } else {
            // error display
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
     * @param string $lib
     */
    public function isLibInstalled($lib) {
        $isLibInstalled = false;
        // is the lib name match one on the App/lib folder name
        if (in_array($lib, $this->getLibs())) {
            // is the lib main file exist
            if(file_exists(__DIR__ .'/lib/'.$lib.'/'.$lib.'.php')) {
                $isLibInstalled = true;
            }
        }
        return (bool)$isLibInstalled;
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
        // internal style sheet
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
        // current URL
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        // construct HTML
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
