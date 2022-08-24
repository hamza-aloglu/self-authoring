<?php

namespace app\attributes;

use app\enums\HttpRequests;
use Attribute;

#[Attribute(Attribute::IS_REPEATABLE|Attribute::TARGET_METHOD)]
class Get extends Route
{
    public function __construct(string $url)
    {
        parent::__construct(HttpRequests::Get, $url);
    }
}