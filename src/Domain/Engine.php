<?php

namespace App\Domain;

use App\Domain\Actions\ActionNotPossibleException;
use App\Domain\Actions\UndefinedActionException;
use App\Domain\Entity\Player;

class Engine
{
    public static function run(Game $game): void
    {
        $game->start();

        $players = $game->getPlayers();
        $interactionInterface = $game->getConfig()->getInteractionInterface();
        $playersCount = count($players) - 1;

        while (true) {
            for ($pointer = 0; $pointer <= $playersCount; $pointer++) {
                /**
                 * @var Player $player
                 */
                $player = $players[$pointer];
                $interactionInterface->beforeTurnSummary($player, $game->getState());

                try {
                    $action = $player->makeTurnDecision($game->getPile());
                    $action->execute();
                } catch (ActionNotPossibleException $exception) {
                    $interactionInterface->message($exception->getMessage());

                    // move the pointer back and make the player turn again
                    --$pointer;
                    continue;
                } catch (UndefinedActionException $exception) {
                    $interactionInterface->message($exception->getMessage());

                    // move the pointer back and make the player turn again
                    --$pointer;
                    continue;
                }

                $interactionInterface->afterTurnSummary($player, $action, $game->getState());

                $winner = $game->checkForWinner();

                if (null !== $winner) {
                    $interactionInterface->winnerSummary($winner);

                    break 2;
                }
            }
        }

        $game->finish();
    }
}