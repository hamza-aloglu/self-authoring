<?php

namespace app\types;

use app\interfaces\IEmailState;

class DeliverableEmail implements IEmailState
{
    public function isValid(): bool
    {
        return true;
    }

    public function __toString(): string
    {
        return "Valid e-mail";
    }
}