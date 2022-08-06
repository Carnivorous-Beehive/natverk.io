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

        $args = array_key_exists('query', $request) ? $this->getQueryStringArgs($request['query']) : array();

        [$matched_path, $parameters] = $this->matchedPath($request['path']);

        if (!$this->isRouteHandled($method, $matched_path)) {
            http_response_code(404);
            call_user_func($this->routes[404]);
            die();
        }

        $args = array_merge($args, $parameters);
        call_user_func($this->routes[$matched_path][$method], $args);
        die();
    }

    private function registerRoute(string $verb, string $path, callable $handler): self {
        $this->routes[$path][$verb] = $handler;

        return $this;
    }

    private function isRouteHandled(string $verb, ?string $path): bool {
        if (is_null($path)) {
            return false;
        }

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

    private function matchedPath(string $path): array {
        if (array_key_exists($path, $this->routes)) {
            return array($path, array());
        }

        $routes = preg_grep("/:\w+/", array_keys($this->routes));
        $expressions = array_map(function ($route) use($path) {
            preg_match("/:\w+/", $route, $arg);
            return array(
                $route,
                str_replace('/', '\/', preg_replace("/:\w+/", "(\w+)", $route)),
                $arg,
                $path,
            );
        }, $routes);

        foreach ($expressions as [$route, $re, $arg, $path]) {
            preg_match("/$re$/", $path, $matches);
            if (count($matches) > 0) {
                $parameter = array_combine(
                    str_replace(':', '', $arg),
                    array($matches[count($matches) - 1]),
                );
                return array($route, $parameter);
            }
        }

        return array(null, null);
    }
}
