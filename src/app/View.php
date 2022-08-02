<?php

namespace app;

class View
{
    public static function make(string $fileName, array $attributes)
    {
        $fullFileName = __DIR__ . '/../views/' . $fileName . '.php';

        foreach ($attributes as $key => $value) {
            $$key = $value;
        }

        include $fullFileName;

    }
}