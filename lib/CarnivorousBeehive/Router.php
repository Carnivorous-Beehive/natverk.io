<?php

namespace CarnivorousBeehive;

class Router {
    private $routes;
    private $staticDirectory;

    public function __construct() {
        $this->routes = array();
    }

    public function static(string $dir): self {
        $this->staticDirectory = $dir;

        return $this;
    }

    public function get(string $path, callable $handler): self {
        return $this->registerRoute('GET', $path, $handler);
    }

    public function notFound(callable $handler): self {
        $this->routes[404] = $handler;

        return $this;
    }

    public function handle() {
        $request = parse_url($_SERVER['REQUEST_URI']);
        $method = $_SERVER['REQUEST_METHOD'];

        $args = array_merge(
            array_key_exists('query', $request) ? $this->getQueryStringArgs($request['query']) : array(),
        );

        if (!$this->isRouteHandled($method, $request['path'])) {
            http_response_code(404);
            call_user_func($this->routes[404]);
            die();
        }

        call_user_func($this->routes[$request['path']][$method], $args);
        die();
    }

    private function registerRoute(string $verb, string $path, callable $handler): self {
        $this->routes[$path][$verb] = $handler;

        return $this;
    }

    private function isRouteHandled(string $verb, string $path): bool {
        return array_key_exists($path, $this->routes) &&
            array_key_exists($verb, $this->routes[$path]);
    }

    private function getQueryStringArgs(string $qs): array {
        return array_reduce(explode('&', $qs), function ($hash, $pair) {
           [$key, $value] = explode('=', $pair);
           $hash[$key] = $value;
           return $hash;
        });
    }
}
