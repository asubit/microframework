<?php

include('Theme.php');

/**
 * Controller
 * This class is instanciate for each other Controller
 */
class Controller {

    /**
     * Template variables
     */
    public $variables = [];

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
