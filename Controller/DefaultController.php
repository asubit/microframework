<?php

include('App/Controller.php');

// Instanciate Controller
$controller = new Controller();

// Define template variables
$controller->variables = [
    'title' => 'Hello world',
    'content' => '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p><p>Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p><p>Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p><p>Nullam dictum felis eu pede mollis pretium.</p><p><a class="btn btn-primary" href="/page?id=1">Page 1</a><a class="btn btn-default" href="/page?id=2">Page 2</a>'
];

// Render template
$controller->render('home');
