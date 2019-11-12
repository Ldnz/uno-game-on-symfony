<?php

namespace App\Domain\Ai;

use App\Domain\Actions\ActionInterface;
use App\Domain\Entity\Pile;
use App\Domain\Entity\Player;

interface AiInterface
{
    public function decide(Player $player, Pile $pile): ActionInterface;
}