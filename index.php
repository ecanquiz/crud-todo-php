<?php
// https://www.youtube.com/playlist?list=PLr3d3QYzkw2xabQRUpcZ_IBk9W50M9pe-
// https://www.youtube.com/watch?v=CF7Yy5cPFVM
// https://www.youtube.com/watch?v=JdrvETQCAGw&list=PLr3d3QYzkw2xabQRUpcZ_IBk9W50M9pe-&index=58
// https://www.youtube.com/watch?v=JdrvETQCAGw&list=PLr3d3QYzkw2xabQRUpcZ_IBk9W50M9pe-&index=59&t=462s
// https://www.youtube.com/watch?v=QiO0uUwOiBg&list=PLr3d3QYzkw2xabQRUpcZ_IBk9W50M9pe-&index=62&t=290s
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/database.php'; // Confirma que el nombre del archivo es correcto
/** */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Permitir todos los métodos
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Si la solicitud es OPTIONS, enviar una respuesta vacía con los encabezados CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}


$router = new App\Router();
$router->get('/test', function () { echo 'Test function'; } );

$router->get('/database', function() {
    $db = getDB();
    if ($db) {
        echo "Conexión a la base de datos establecida con éxito!";
    } else {
        echo "Falló la conexión a la base de datos.";
    }
});


/* $router->post('/tasks', function() {
    $response = App\Controllers\Task::create();
    echo $response;
}); */


$router
    ->get( '/', [App\Controllers\Home::class, 'index'])
    ->get( '/tasks', [App\Controllers\Task::class, 'index'])
    ->get( '/tasks/{id}', [App\Controllers\Task::class, 'show'])
    ->post( '/tasks', [App\Controllers\Task::class, 'store'])
    ->put('/tasks/{id}', [App\Controllers\Task::class, 'update'])
    ->delete('/tasks/{id}', [App\Controllers\Task::class, 'delete']);


    //->register( '/tasks', [App\Controllers\Task::class, 'show'])
    //->post( '/tasks', [App\Controllers\Task::class, 'store']);

echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
