<?php

namespace app\exceptions;

class ViewNotFoundException extends \Exception
{
    protected $message = 'View not found';
}