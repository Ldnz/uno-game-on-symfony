<?php

namespace App\Domain\PlayerInteraction;

use App\Domain\Actions\ActionInterface;
use App\Domain\Entity\GameState;
use App\Domain\Entity\Player;

interface InteractionInterface
{
    public function message(string $message): void;

    public function askForAction(): string;

    public function askForCard(Player $player): string;

    public function beforeTurnSummary(Player $player, GameState $state): void ;

    public function afterTurnSummary(Player $player, ActionInterface $action, GameState $state): void;

    public function winnerSummary(Player $player): void;
}
