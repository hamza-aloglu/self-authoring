<?php

namespace DataProviders;

class RouterDataProvider
{
    public function routeNotFoundCases(): array
    {
        return [
            ['url', 'put'], // request method does not exist
            ['randomUrl', 'get'], // url does not exist
            ['url', 'post'], // class does not exist
            ['url', 'get'] // method does not exist
        ];
    }
}