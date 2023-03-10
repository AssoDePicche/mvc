<?php

declare(strict_types=1);

namespace Http;

final class Router
{
    private readonly string $prefix;

    private array $routes = [];

    private readonly Request $request;

    public function __construct(
        private readonly string $url
    ) {
        $this->request = new Request;

        $this->prefix = parse_url($url, PHP_URL_PATH) ?? '';
    }

    public function __call(string $methodName, array $methodParams): void
    {
        $allowedMethods = ['GET', 'POST'];

        $methodName = strtoupper($methodName);

        if (false === in_array($methodName, $allowedMethods)) {
            throw new \BadMethodCallException('Invalid Method Name');
        }

        [$route, $callback] = $methodParams;

        $routeParameters = ['controller' => [], 'variable' => []];

        if ($callback instanceof \Closure) {
            $routeParameters['controller'] = $callback;
        }

        $variablePattern = '/{(.*?)}/';

        if (preg_match_all($variablePattern, $route, $matches)) {
            $route = preg_replace($variablePattern, '(.*?)', $route);

            $routeParameters['variable'] = end($matches);
        }

        $routePattern = '/^' . str_replace('/', '\/', $route) . '$/';

        $this->routes[$routePattern][$methodName] = $routeParameters;
    }

    private function getRoute()
    {
        $uri = $this->request->uri;

        $uri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        $route = end($uri);

        $httpMethod = $this->request->method;

        foreach ($this->routes as $routePattern => $method) {
            if (false == preg_match($routePattern, $route, $matches)) {
                continue;
            }

            if (true === isset($method[$httpMethod])) {
                unset($matches[0]);

                $keys = $method[$httpMethod]['variable'];

                $method[$httpMethod]['variable'] = array_combine($keys, $matches);

                $method[$httpMethod]['variable']['request'] = $this->request;

                return $method[$httpMethod];
            }

            throw new \Http\Exception\MethodNotAllowedException;
        }

        throw new \Http\Exception\NotFoundException;
    }

    public function run(): \Http\Response
    {
        try {
            $route = $this->getRoute();

            if (false === isset($route['controller'])) {
                throw new \Http\Exception\InternalServerErrorException;
            }

            $args = [];

            $reflection = new \ReflectionFunction($route['controller']);

            foreach ($reflection->getParameters() as $parameter) {
                $parameterName = $parameter->getName();

                $args[$parameterName] = $route['variable'][$parameterName] ?? '';
            }

            return call_user_func_array($route['controller'], $args);
        } catch (\Exception $exception) {
            return new Response(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
