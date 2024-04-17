<?php
require __DIR__ . '/vendor/autoload.php';

$router = new App\Router();


$router
    ->register( '/', [App\Controllers\Task::class, 'index'])
    ->register( '/tasks', [App\Controllers\Task::class, 'show'])
    ->register( '/tasks/create', [App\Controllers\Task::class, 'create']);

//$router->register(
//    '/tasks',
//    function () {
//        echo 'Tasks';
//    }
//);

// https://www.youtube.com/watch?v=CF7Yy5cPFVM

echo $router->resolve($_SERVER['REQUEST_URI']);
