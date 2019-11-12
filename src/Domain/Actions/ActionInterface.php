<?php

namespace App\Domain\Actions;

use App\Domain\Entity\Pile;
use App\Domain\Entity\Player;

interface ActionInterface
{
    public function __construct(Player $player, Pile $pile);

    public function execute();
    public function getName();
}