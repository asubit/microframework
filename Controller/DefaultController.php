<?php

include('App/Controller.php');

// Instanciate Controller
$controller = new Controller();

// Define template variables
$controller->variables = [
	'date' => new \DateTime(),
	'pages' => [1,2],
];

// Render template
$controller->render('home');
