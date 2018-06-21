<?php

/**
 * BaseController
 * This class is instanciate for each other Controller
 */
class BaseController {

    /**
     * Template variables
     */
    public $variables = [];

    /**
     * Render template
     */
    public function render($view) {
       include(__DIR__ . '/../View/' . $view . '.php');
    }
}
