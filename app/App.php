<?php

namespace app;

use app\exceptions\RouteNotFoundException;

class App
{
    private static Database $db;

    public function __construct(protected Router $router, protected Config $config)
    {
        static::$db = new Database($config->db);
    }

    public static function db()
    {
        return static::$db;
    }

    public function run(array $request)
    {
        try {
            echo $this->router->resolve($request['uri'], strtolower($request['method']));
        } catch (RouteNotFoundException) {
            http_response_code(404);
            echo View::make('error/404');
        }
    }
}