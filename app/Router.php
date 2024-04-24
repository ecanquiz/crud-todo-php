<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;

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
    
    // En tu método resolve dentro de Router.php
public function resolve($requestUri, $requestMethod)
{
    $route = explode('?', $requestUri)[0];
    $action = $this->routes[strtolower($requestMethod)][$route] ?? null;
    
    if (!$action) {
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
        exit; // Salimos del script después de manejar el error
    }

    if (is_callable($action)) {
        return call_user_func($action);
    }

    if (is_array($action)) {
        [$class, $method] = $action;
        if (class_exists($class) && method_exists($class, $method)) {
            $classInstance = new $class();
            return call_user_func([$classInstance, $method]);
        }
    }

    throw new RouteNotFoundException("No route defined for $route");
}

}
