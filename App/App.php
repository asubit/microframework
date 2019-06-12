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
                echo $this->debugBar($this->env);
                break;

            default:
                break;
        }
    }
    
    public function debugBar($env) {
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
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $content = '<div>' . $env . '</div>';
        $content .= '<div>' . $_SERVER['REQUEST_METHOD'] . ' ' . $url . '</div>';
        $content .= '<div style="background-color: '.$color.'">HTTP ' . http_response_code() . '</div>';
        $debugBar = $style . '<div class="debugbar">' . $content . '</div>';
        return $debugBar;
    }
}
