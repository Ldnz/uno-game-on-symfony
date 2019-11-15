<?php

namespace App\Domain\Fabric;

use App\Domain\Ai\AiInterface;
use App\Domain\Entity\AiPlayer;
use App\Domain\Entity\Pile;
use App\Domain\Entity\Player;
use App\Domain\Entity\RealPlayer;
use App\Domain\Game;
use App\Domain\PlayerInteraction\InteractionInterface;

class PlayerFabric
{
    /**
     * @param Pile $pile
     * @param string $name
     * @param AiInterface $ai
     * @return Player
     */
    public static function createBot(Pile $pile, string $name, AiInterface $ai): Player
    {
        return self::init(new AiPlayer($ai), $pile, $name);
    }

    /**
     * @param Pile $pile
     * @param string $name
     * @param InteractionInterface $interaction
     *
     * @return Player
     */
    public static function createReal(Pile $pile, string $name, InteractionInterface $interaction): Player
    {
        return self::init(new RealPlayer($interaction), $pile, $name);
    }

    /**
     * @param Player $player
     * @param Pile $pile
     * @param string $name
     *
     * @return Player
     */
    private static function init(Player $player, Pile $pile, string $name): Player
    {
        $player->setName($name);

        for ($cardNumber = 0; $cardNumber < Game::INITIAL_CARDS_AMOUNT; $cardNumber++) {
            $player->addCard($pile->pop());
        }

        return $player;
    }
}