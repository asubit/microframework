# Asubit Microframework

Simple minimalist PHP micro framework that provides you anything you need :
- App environment management
- Route declaration
- Route/Controller matching system
- Controller/View matching system

Asubit Microframework allow you to do everything you want without any constraints.

## How minimalist?

The index.php file just do two things : 
```
// init app
$app = new App('dev');

// init routing
$routing = new Routing();
$routing->go();
```

## How simple?

The routing system just do one thing :

```
public function go() {
        $routes = json_decode(file_get_contents(__DIR__ . '/config/routing.json'));
        $path = $this->getPath();
        // Route/Controller matching system
        if (isset($routes->$path->controller)) {
            include $routes->$path->controller;
        } else {
            http_response_code(404);
            include 'views/404.php';
            die();
        }
    }
```

## How use it?

Following steps show you how to create a new page with Route/Controller/View system.

### 1. Create a route in routing.json
For this example we are going to create the route named `page` with URL `/page`.
```
{
    "page": {
        "path": "/page",
        "controller": "Controller/Page.php"
    }
}
```
As you can see all app routes are define in a first level array with following structure : 
```
['the-route-name' => [
  'path' => '/the-route-url',
  'controller' => 'the-route-controller-file-path'
]]
```

### 2. Create a controller
For this example we are going to create the file `Controller/Page.php`.
```
<?php
include('BaseController.php');

// Instanciate BaseController
$controller = new BaseController();

// Define template variables
$controller->variables = [
    'title' => 'Hello world',
    'content' => '<p>Lorem ipsum dolor sit amet.</p>'
];

// Render template
$controller->render('home');
```

### 3. Create a view
The `BaseController:render()` method is based on the controller name in lowercase for matching the corresponding view file in `View` directory.
So for this example we are going to create the file `View/page.php`.
```
<?php include('base_header.php'); ?>

<h1><?php echo $this->variables['title']; ?></h1>

<div class="content">
    <?php echo $this->variables['content']; ?> 
</div>

<?php include('base_footer.php'); ?>
```

You can include any template you want for create any laout you need.
