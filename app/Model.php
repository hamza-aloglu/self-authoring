<?php

namespace app;

abstract class Model
{
    protected Database $em;

    public function __construct()
    {
        $this->em = App::em();
    }

}