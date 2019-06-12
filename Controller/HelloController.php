<?php
include('App/Controller.php');

// Instanciate Controller
$controller = new Controller();

// Define template variables
$controller->variables = [
    'foo' => 'Hello world',
    'bar' => '<p>Great too see you here!</p>'
];

// Render template
$controller->render('hello');