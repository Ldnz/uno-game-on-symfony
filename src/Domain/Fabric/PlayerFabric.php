<?php


namespace App\Domain\Fabric;


use App\Domain\Entity\Pile;
use App\Domain\Entity\Player;
use App\Domain\Game;

class PlayerFabric
{
    /**
     * @param Pile $pile
     * @param string $playerName
     *
     * @return Player
     */
    public static function create(Pile $pile, string $playerName)
    {
        $player = new Player();
        $player->setName($playerName);

        for ($cardNumber = 0; $cardNumber < Game::INITIAL_CARDS_AMOUNT; $cardNumber++) {
            $player->addCard($pile->pop());
        }

        return $player;
    }
}