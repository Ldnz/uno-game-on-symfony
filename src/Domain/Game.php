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
     * @var GameConfig
     */
    private $config;

    /**
     * Game constructor.
     * @param GameConfig $config
     */
    public function __construct(GameConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return GameConfig
     */
    public function getConfig(): GameConfig
    {
        return $this->config;
    }

    /**
     * start game
     */
    public function start(): void
    {
        $this->initPile();
        $this->initBots();
        $this->initPlayer();
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
        $players = $this->getPlayers();

        /**
         * @var Player $player
         */
        foreach ($players as $player) {
            if (0 === count($player->getCardsOnHands())) {
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
    public function getPlayers()
    {
        return array_merge([$this->player], $this->bots);
    }

    /**
     * @return Pile
     */
    public function getPile(): Pile
    {
        return $this->pile;
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
        $ai = $this->getConfig()->getAi();

        for ($i = 0; $i < self::BOTS_MAX_AMOUNT; $i++) {
            $name = sprintf("Bot %s", $i);

            array_push($this->bots, PlayerFabric::createBot($this->pile, $name, $ai));
        }
    }

    /**
     * initializing a real player
     */
    private function initPlayer(): void
    {
        $name = $this->getConfig()->getPlayerName();
        $interaction = $this->getConfig()->getInteractionInterface();

        $this->player = PlayerFabric::createReal($this->pile, $name, $interaction);
    }
}
