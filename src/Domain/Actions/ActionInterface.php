<?php

namespace App\Domain\Actions;

use App\Domain\Entity\Pile;
use App\Domain\Entity\Player;

interface ActionInterface
{
    public function __construct(Player $player, Pile $pile);

    /**
     * @throws ActionNotPossibleException
     */
    public function execute(): void;

    /**
     * @return string
     */
    public function getName(): string ;
}