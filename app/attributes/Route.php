<?php

namespace app\attributes;

use app\enums\HttpRequests;
use Attribute;

#[Attribute]
abstract class Route
{
    public function __construct(public HttpRequests $reqMethod, public string $url)
    {
    }
}