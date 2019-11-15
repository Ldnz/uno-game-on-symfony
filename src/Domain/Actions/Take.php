<?php

namespace App\Domain\Actions;

class Take extends AbstractAction
{
    public const NAME = 'Take';

    public function execute(): void
    {
        $this->player->addCard($this->pile->pop());
    }
}
