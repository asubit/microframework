<?php

class App {

    protected $env;

    protected $theme;

    public function __construct($env = 'dev') {
        // Init asubit microframework app
        $this->env = $env;
    }

    /*
     * Init asubit microframework app
     */
    public function init() {
        switch ($this->env) {
            case 'dev':
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                echo $this->debugBar();
                break;

            default:
                break;
        }
    }
    
    public function debugBar() {
        $content = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $debugBar = '<div style="position:fixed;bottom:0px;width:100%;background:#eee;border-top:black 1px solid;">'.$content.'</div>';
        return $debugBar;
    }
}
