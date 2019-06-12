<?php

include('App/Controller.php');

// Instanciate Controller
$controller = new Controller();

// Render template
$controller->render('404');
http_response_code(404);
