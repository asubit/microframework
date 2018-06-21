<?php

class App {

    protected $env;

    public function __construct($env = 'dev') {
        $this->env = $env;
        $this->init($this->env);
    }

    public function init($env) {
        switch ($env) {
            case 'dev':
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                echo $this->getDebugBar();
                break;

            default:
                break;
        }
    }

    public function getDebugBar() {
        return '<div style="position: fixed;bottom: 0px;width: 100%; background: #eee; border-top: black 1px solid;">dev</div>';
    }
}
