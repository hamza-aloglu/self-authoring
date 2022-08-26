<?php

namespace app;

abstract class Model
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::db();
    }

}