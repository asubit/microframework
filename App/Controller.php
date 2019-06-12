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
                $data = simplexml_load_file(__DIR__ . '/../Data/'.$this->model.'/'.$this->model.'-'.$id.'.xml') or die("Failed to load data");
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
     * Render template
     */
    public function render($view) {
        $theme = new Theme();
        include(__DIR__ . '/../View/' . $theme->getHeader());
        include(__DIR__ . '/../View/' . $view . '.php');
        include(__DIR__ . '/../View/' . $theme->getFooter());
    }
}
