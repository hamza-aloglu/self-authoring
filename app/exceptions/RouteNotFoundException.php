<?php

namespace app\exceptions;


class RouteNotFoundException extends \Exception
{
    protected $message = 'Route not found';
}