<?php

namespace app\interfaces;

interface IEmailState
{
    public function isValid();

    public function __toString(): string;
}