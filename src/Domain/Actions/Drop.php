<?php

namespace App\Domain\Actions;

class Drop extends AbstractAction
{
    public const NAME = 'Drop';

    public function execute()
    {
        $this->pile->append($this->player->getCardForMove());
    }
}