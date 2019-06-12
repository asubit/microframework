<?php

include('App/Controller.php');

// Instanciate Controller
$controller = new Controller('page');

$id = $_GET['id'];

$page = $controller->get($id);

// Define template variables
$controller->variables = [
    'title' => $page->title,
    'content' => $page->content
];

// Render template
$controller->render('page');
