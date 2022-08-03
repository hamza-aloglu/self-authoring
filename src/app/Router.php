<?php

namespace app;

class Router
{
    public array $routes;

    public function register(string $reqMethod, string $url, callable|array $action): self
    {
        $this->routes[$reqMethod][$url] = $action;
        return $this;
    }

    public function get(string $url, callable|array $action): self
    {
        return $this->register('get', $url, $action);
    }

    public function post(string $url, callable|array $action): self
    {
        return $this->register('post', $url, $action);
    }

    public function run(string $requestURI, string $requestMethod)
    {
        $requestMethod = strtolower($requestMethod);
        $url = explode("?", $requestURI)[0];
        if ($action = $this->routes[$requestMethod][$url]) {

            if (is_callable($action)) {
               return call_user_func($action);
            }

            if (is_array($action)) {
                [$class, $method] = $action;

                if (class_exists($class)) {
                    $class = new $class();

                    if (method_exists($class, $method)) {
                        return call_user_func_array([$class, $method], []);
                    }
                }
            }
        }
        echo "404";
    }
}