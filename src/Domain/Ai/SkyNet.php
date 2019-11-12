<?php

namespace App\Domain\Ai;

use App\Domain\Actions\AbstractAction;
use App\Domain\Actions\ActionInterface;
use App\Domain\Actions\Skip;
use App\Domain\Entity\Pile;
use App\Domain\Entity\Player;

class SkyNet implements AiInterface
{
    /**
     * @param Player $player
     * @param Pile $pile
     *
     * @return ActionInterface
     *
     * @throws \Exception
     */
    public function decide(Player $player, Pile $pile): ActionInterface
    {
        // we can place here some logic to determine which action will be the best
        // for player at this moment
        return AbstractAction::create(Skip::NAME, $player, $pile);
    }
}