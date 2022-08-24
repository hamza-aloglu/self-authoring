<?php

namespace app\attributes;

use app\enums\HttpRequests;
use Attribute;

#[Attribute]
class Route
{
    public function __construct(public HttpRequests $reqMethod, public string $url)
    {
    }
}