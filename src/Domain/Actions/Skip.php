<?php

namespace App\Domain\Actions;

class Skip extends AbstractAction
{
    public const NAME = 'Skip';

    public function execute()
    {
        return null;
    }
}