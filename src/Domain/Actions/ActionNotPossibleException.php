<?php

namespace App\Domain\Actions;

class ActionNotPossibleException extends \Exception
{
    protected $message = 'Action can\'t be executed!';
}
