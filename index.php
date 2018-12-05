<?php

include('App/App.php');
include('App/Routing.php');

// Init the Asubit Microframework App
$app = new App('dev');
//$app->init();

// Instanciate routing
$routing = new Routing();
// Match the current route URL and call associated controller class
$routing->go();

$app->init();
