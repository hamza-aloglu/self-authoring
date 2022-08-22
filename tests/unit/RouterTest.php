<?php

declare(strict_types=1);

namespace unit;

use app\exceptions\RouteNotFoundException;
use app\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private Router $router;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->router = new Router();
        
    }


    /** @test */
    public function canRegisterRoute()
    {
        $this->router->register('method', 'url', ['className', 'methodName']);

        $expectedRouter = [
            'method' => [
                'url' => ['className', 'methodName'],
            ],
        ];

        $this->assertSame($expectedRouter, $this->router->routes());
    }

    /** @test */
    public function canRequestGetRoute()
    {
        $this->router->get('url', ['className', 'methodName']);

        $expectedRouter = [
            'get' => [
                'url' => ['className', 'methodName'],
            ],
        ];

        $this->assertSame($expectedRouter, $this->router->routes());
    }

    /** @test */
    public function canRequestPostRoute()
    {
        $this->router->post('url', ['className', 'methodName']);

        $expectedRouter = [
            'post' => [
                'url' => ['className', 'methodName'],
            ],
        ];

        $this->assertSame($expectedRouter, $this->router->routes());
    }

    /** @test */
    public function isRoutesEmptyWhenRouterIsJustCreated()
    {
        $router = new Router();

        $this->assertEmpty($router->routes());
    }

    /**
     * @test
     * @dataProvider \DataProviders\RouterDataProvider::routeNotFoundCases
     */
    // action does not exist, class does not exist, method does not exist.
    public function canThrowRouteNotFoundException(string $requestURI,
                                                   string $requestMethod)
    {
        $class = new class {
            public function method()
            {
                echo "operation...";
            }
        };

        $this->router->get('url', [$class::class, 'getMethod']);
        $this->router->post('url', ['class', 'method']);

        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestURI, $requestMethod);
    }

    /** @test  */
    public function canResolveRouteFromClosure()
    {
        $expectedResult = [1, 2, 3];
        $this->router->get('url', fn() => $expectedResult );

        $this->assertSame(
            $expectedResult,
            $this->router->resolve('url', 'get')
        );

    }

    /** @test */
    public function canResolveRouteFromMethodOfClass()
    {
        $class = new class {
            public function method()
            {
                return [1, 2, 3];
            }
        };
        $this->router->get('url', [$class::class, 'method']);

        $this->assertSame(
            [1, 2, 3],
            $this->router->resolve('url', 'get')
        );
    }
}