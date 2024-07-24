<?php

function route(string $path, callable $callback){
    global $routes;
    $routes[$path] = $callback;
}

$routes = [];

require_once './public/routes/index.php';
run();

function run(){
    global $routes;
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if(array_key_exists($path, $routes)){
        call_user_func($routes[$path]);
        
    } else {
        require_once './public/view/404.php';
    }
}


