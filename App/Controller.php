<?php

include('Theme.php');

/**
 * Controller
 * This class is instanciate for each other Controller
 */
class Controller {

    /**
     * Model used
     */
    private $model;

    /**
     * Template variables
     */
    public $variables = [];

    /**
     * Controller constructor
     */
    public function __construct($model = null) {
        $this->model = $model;
    }

    /**
     * Show model
     */
    public function get($id = null) {
        if ($id) {
            $filename = __DIR__ . '/../Data/'.$this->model.'/'.$this->model.'-'.$id.'.xml';
            if (file_exists($filename)) {
                $data = simplexml_load_file(__DIR__ . '/../Data/'.$this->model.'/'.$this->model.'-'.$id.'.xml') or die('Failed to load data');
                return $data;
            } else {
                $this->render('404');
                exit;
            }
        } else {
            $this->render('404');
            exit;
        }
    }

    /**
     * Render a view
     * @param string $view
     * @param string $lib
     */
    public function render($view, $lib = false) {
        // Get current theme
        $theme = new Theme();
        // Display theme header
        include(__DIR__ . '/../View/' . $theme->getHeader());
        // Construct view path
        $path = __DIR__ . '/../View/' . $view . '.php';
        if ($lib) {
            $path = __DIR__ . '/lib/'.$lib.'/View/' . $view . '.php';
        }
        // Display view
        try {
            if (file_exists(__DIR__ . '/../View/' . $view . '.php')) {
                include($path);
            } else {
                throw new Exception('Can not find the view ' . $view . ' in ' . $path);
                
            }
        } catch (Exception $e) {
            
        }
        // Display theme footer
        include(__DIR__ . '/../View/' . $theme->getFooter());
    }
}
