<?php

include('App/App.php');

// Init the Asubit Microframework App
$app = new App('dev');

// Enable libraries
$libraries = ['cms'];

// Load app et libraries
$app->run($libraries);

// Match the current URL and call associated Controller class
$app->route();
