<?php

namespace app\exceptions;

use mysql_xdevapi\Exception;

class RouteNotFoundException extends Exception
{
    protected $message = 'Route not found';
}