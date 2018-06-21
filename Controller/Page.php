<?php

include('BaseController.php');

// Instanciate BaseController
$controller = new BaseController();

// Define template variables
$controller->variables = [
    'title' => 'Page',
    'content' => '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p><p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>'
];

// Render template
$controller->render('page');
