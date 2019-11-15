<?php

namespace App\Domain\Actions;

class UndefinedActionException extends \Exception
{
    protected $message = 'Undefined type of action.';
}