<?php

namespace app\types;

use app\interfaces\IEmailState;

class RiskyEmail implements IEmailState
{
    public function isValid(): bool
    {
        return false;
    }

    public function __toString()
    {
        return "Your e-mail is risky.";
    }
}