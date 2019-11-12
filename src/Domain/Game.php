<?php


namespace App\Domain;

use App\Domain\Entity\GameState;
use App\Domain\Entity\Pile;
use App\Domain\Entity\Player;
use App\Domain\Fabric\PileFabric;
use App\Domain\Fabric\PlayerFabric;

class Game
{
    public const INITIAL_CARDS_AMOUNT = 7;

    private const BOTS_MAX_AMOUNT = 3;

    /**
     * @var Player
     */
    private $player;
    /**
     * @var Player[]
     */
    private $bots = [];
    /**
     * @var Pile
     */
    private $pile;

    /**
     * @param string $playerName
     */
    public function start(string $playerName): void
    {
        $this->initPile();
        $this->initBots();
        $this->initPlayer($playerName);
    }

    public function finish(): void
    {
        // there can be some logic
    }

    /**
     * @return Player|null
     */
    public function checkForWinner(): ?Player
    {
        $players = array_merge([$this->getPlayer()], $this->getBots());

        /**
         * @var Player $player
         */
        foreach ($players as $player) {
            if (0 === $player->getCardsOnHands()) {
                return $player;
            }
        }

        return null;
    }

    /**
     * @return GameState
     */
    public function getState(): GameState
    {
        $state = new GameState();
        $state->setTotalCardsOnPile($this->pile->getCountOfCards());
        $state->setTopCard($this->pile->getTopCard());

        return $state;
    }

    /**
     * @return Player[]
     */
    public function getBots()
    {
        return $this->bots;
    }

    /**
     * @return Pile
     */
    public function getPile(): Pile
    {
        return $this->pile;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * initializing a pile
     */
    private function initPile(): void
    {
        $this->pile = PileFabric::create();
    }

    /**
     * initializing a bots
     */
    private function initBots() : void
    {
        for ($i = 0; $i < self::BOTS_MAX_AMOUNT; $i++)
        {
            array_push($this->bots, PlayerFabric::create($this->pile, sprintf("Bot %s", $i)));
        }
    }

    /**
     * initializing a real player
     *
     * @param string $playerName
     */
    private function initPlayer(string $playerName): void
    {
        $this->player = PlayerFabric::create($this->pile, $playerName);
    }
}