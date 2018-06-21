<?php

include('BaseController.php');

// Instanciate BaseController
$controller = new BaseController();

// Define template variables
$controller->variables = [
    'title' => 'Hello world',
    'content' => '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><p>Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p><p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p><p>Nullam dictum felis eu pede mollis pretium.</p>'
];

// Render template
$controller->render('home');
