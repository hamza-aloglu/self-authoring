<?php

namespace app;

use app\attributes\Route;
use app\exceptions\RouteNotFoundException;
use ReflectionClass;

class Router
{
    public array $routes = [];

    public function registerRoutesFromControllersViaMethodAttributes(array $controllers)
    {
        foreach ($controllers as $controller) {
            $reflectionController = new ReflectionClass($controller);

            foreach ($reflectionController->getMethods() as $method) {
                $attributeClasses = $method->getAttributes(Route::class, \ReflectionAttribute::IS_INSTANCEOF);

                foreach ($attributeClasses as $attributeClass) {
                    $instanceAttributeClass = $attributeClass->newInstance();

                    $this->register($instanceAttributeClass->reqMethod->value, $instanceAttributeClass->url, [$controller, $method->getName()]);
                }
            }
        }
    }


    public function register(string $reqMethod, string $url, callable|array $action): self
    {
        $this->routes[$reqMethod][$url] = $action;
        return $this;
    }

    public function routes(): array
    {
        return $this->routes;
    }

    public function resolve(string $requestURI, string $requestMethod)
    {
        $requestMethod = strtolower($requestMethod);
        $url = explode("?", $requestURI)[0];

        $action = $this->routes[$requestMethod][$url] ?? null;
        if (!$action) {
            throw new RouteNotFoundException();
        }
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
        throw new RouteNotFoundException();
    }
}