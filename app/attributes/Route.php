<?php

namespace app\attributes;

use Attribute;

#[Attribute]
class Route
{
    public function __construct(public string $reqMethod, public string $url)
    {
    }
}