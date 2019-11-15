<?php

namespace App\Domain\Ai;

use App\Domain\Actions\ActionInterface;
use App\Domain\Actions\UndefinedActionException;
use App\Domain\Entity\Pile;
use App\Domain\Entity\Player;

interface AiInterface
{
    /**
     * @param Player $player
     * @param Pile $pile
     *
     * @return ActionInterface
     * @throws UndefinedActionException
     */
    public function decide(Player $player, Pile $pile): ActionInterface;
}
