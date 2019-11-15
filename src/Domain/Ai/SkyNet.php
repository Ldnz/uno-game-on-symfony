<?php

namespace App\Domain\Ai;

use App\Domain\Actions\AbstractAction;
use App\Domain\Actions\ActionInterface;
use App\Domain\Actions\Take;
use App\Domain\Actions\UndefinedActionException;
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
     * @throws UndefinedActionException
     */
    public function decide(Player $player, Pile $pile): ActionInterface
    {
        // we can place here some logic to determine which action will be the best
        // for player at this moment
        return AbstractAction::create(Take::NAME, $player, $pile);
    }
}
