<?php

    session_start();
    const BASE_PATH = __DIR__.'/../';
    require BASE_PATH.'Core/functions.php';
    require BASE_PATH.'Core/Response.php';
    require base_path('Core/Database.php');
   // require base_path('Core/Response.php');
    require base_path('Core/router.php');
    /*spl_autoload_register(function($class){
        $class = str_replace('\\',DIRECTORY_SEPARATOR,$class);
        
        require base_path("Core/{$class}.php");
    });*/
    //require base_path('Core/router.php');

    $router = new \Core\Router();
    $routes = require base_path('routes.php');
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];
    $router->route($uri,$method);