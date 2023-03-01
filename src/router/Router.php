<?php

declare(strict_types=1);

namespace Router;

final class Router
{
    private array $routes, $request;

    public function __call(string $method, array $arguments): bool
    {
        $method = strtoupper($method);

        if (!in_array($method, ['GET', 'POST'])) {
            throw new \InvalidArgumentException();
        }

        [$route, $callback] = $arguments;

        if (!isset($callback) || !is_callable($callback)) {
            throw new \InvalidArgumentException();
        }

        $this->routes[$method][$route] = $callback;

        return true;
    }

    public function getRequest(): array
    {
        return $this->request;
    }

    public function run(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $route = $_SERVER['REQUEST_URI'] ?? '/';

        if (!isset($this->routes[$method])) {
            throw new \Exception('METHOD NOT ALLOWED', 405);
        }

        if (!isset($this->routes[$method][$route])) {
            throw new \Exception('NOT FOUND', 404);
        }

        $this->request = $method === 'GET' ? $_GET : $_POST;
    }
}
