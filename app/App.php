<?php

namespace app;

use app\exceptions\RouteNotFoundException;

class App
{
    private static Database $em;

    public function __construct(protected Router $router, protected Config $config)
    {
        static::$em = new Database($config->db);
    }

    public static function em()
    {
        return static::$em;
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