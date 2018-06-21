<?php

include('App/App.php');
include('App/Routing.php');

$app = new App('dev');

$routing = new Routing();
$routing->go();
