<?php

namespace App\Domain;

use App\Domain\Ai\AiInterface;
use App\Domain\PlayerInteraction\InteractionInterface;

class GameConfig
{
    /**
     * @var AiInterface
     */
    private $ai;

    /**
     * @var InteractionInterface
     */
    private $interactionInterface;

    /**
     * @var string
     */
    private $playerName;

    /**
     * GameConfig constructor.
     *
     * @param AiInterface $ai
     * @param InteractionInterface $interactionInterface
     * @param string $playerName
     */
    public function __construct(AiInterface $ai, InteractionInterface $interactionInterface, string $playerName)
    {
        $this->ai = $ai;
        $this->interactionInterface = $interactionInterface;
        $this->playerName = $playerName;
    }

    /**
     * @return AiInterface
     */
    public function getAi(): AiInterface
    {
        return $this->ai;
    }

    /**
     * @return InteractionInterface
     */
    public function getInteractionInterface(): InteractionInterface
    {
        return $this->interactionInterface;
    }

    /**
     * @return string
     */
    public function getPlayerName(): string
    {
        return $this->playerName;
    }
}
