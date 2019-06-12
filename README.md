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

$app->run();
```

## How use it?

Following steps show you how to create a new page with Route/Controller/View system.

### 1. Create a route in routing.json
For this example we are going to create the route named `hello` with URL `/hello`.
```
{
    "hello": {
        "path": "/hello",
        "controller": "Controller/HelloController.php"
    }
}
```

### 2. Create a controller
For this example we are going to create the file `Controller/HelloController.php`.
```
<?php
include('App/Controller.php');

// Instanciate Controller
$controller = new Controller();

// Define template variables
$controller->variables = [
    'foo' => 'Hello world',
    'bar' => '<p>Great too see you here!</p>'
];

// Render template
$controller->render('hello');
```

### 3. Create a view
The `Controller:render()` method is based on the controller name in lowercase for matching the corresponding view file in `View` directory.
So for this example we are going to create the file `View/hello.php`.
```
<h1><?php echo $this->variables['foo']; ?></h1>

<div class="content">
    <?php echo $this->variables['bar']; ?> 
</div>
```

You can include any template you want for create any layout you need.

## Data
By default your can store data in XML in `Data/` folder.

## Theming

Do you need to apply a common display theme to all your pages?
Asubit microframework allows you to do that.

### Create a theme

All themes are located in `View` directory.

A theme is defined with at least this following structure:
```
theme-custom
  ├ theme.json
  ├ header.php
  ├ footer.php
```

#### theme.json
```
{
    "name": "Custom theme", # Theme name, purely informative
    "header": "header.php", # File include before your view
    "footer": "footer.php"  # File include after your view
}
```

### Use a theme

To use a theme you have to specify the theme directory name in `App/confog/parameters.json` with key `theme` :
```
{
    "theme": "theme-custom"
}
```

Asubit microframework provide a defult theme based on Bootstrap CDN.
