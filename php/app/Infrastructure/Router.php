<?php

namespace App\Infrastructure;

use App\Infrastructure\Http\Response;

class Router
{
    private array $routes = [];

    public function get(string $path, string $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, string $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function put(string $path, string $handler): void
    {
        $this->routes['PUT'][$path] = $handler;
    }

    public function delete(string $path, string $handler): void
    {
        $this->routes['DELETE'][$path] = $handler;
    }

    public function dispatch(string $requestUri, string $method): Response
    {
        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            if ($route === $requestUri) {
                return $this->invokeHandler($handler);
            }
        }
        // Si la ruta no se encuentra, retornar una respuesta 404
        return $this->notFoundResponse();
    }

    private function invokeHandler(string $handler): Response
    {
        list($controllerName, $action) = explode('@', $handler);
        $controller = new $controllerName();
        return $controller->$action();
    }

    private function notFoundResponse(): Response
    {
        return new Response('404 Not Found', 404);
    }
}
