<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;
/** */

class Router
{
    private array $routes;    
    
    public function register(string $requestMethod, string $route, callable|array $action): self
    {
       $this->routes[$requestMethod][$route] = $action;
       
       return $this;   
    }

    public function get(string $route, callable|array $action): self
    {       
       return $this->register('get', $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {       
       return $this->register('post', $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }
     // Agregar el método put
     public function put(string $route, callable|array $action): self
     {
         return $this->register('put', $route, $action);
     }
    // En tu método resolve dentro de Router.php
public function resolve($requestUri, $requestMethod)
{
    $route = explode('?', $requestUri)[0];
    foreach ($this->routes[strtolower($requestMethod)] as $path => $action) {
        $pattern = "#^" . preg_replace('#\{([a-zA-Z0-9_]+)\}#', '([a-zA-Z0-9_]+)', $path) . "$#";
        if (preg_match($pattern, $route, $matches)) {
            array_shift($matches);  // Eliminar la coincidencia completa
            if (is_callable($action)) {
                return call_user_func_array($action, $matches);
            }
            if (is_array($action)) {
                [$class, $method] = $action;
                if (class_exists($class) && method_exists($class, $method)) {
                    $classInstance = new $class();
                    return call_user_func_array([$classInstance, $method], $matches);
                }
            }
        }
    }

    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
    exit; // Salimos del script después de manejar el error
}


public function delete(string $route, callable|array $action): self {
    return $this->register('delete', $route, $action);
}




}
