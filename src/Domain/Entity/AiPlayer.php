<?php

namespace App\Domain\Entity;

use App\Domain\Actions\ActionInterface;
use App\Domain\Actions\UndefinedActionException;
use App\Domain\Ai\AiInterface;

class AiPlayer extends Player
{
    /**
     * @var AiInterface
     */
    private $brain;

    /**
     * AiPlayer constructor.
     *
     * @param AiInterface $ai
     */
    public function __construct(AiInterface $ai)
    {
        $this->brain = $ai;
    }

    /**
     * @param Pile $pile
     *
     * @return ActionInterface
     *
     * @throws UndefinedActionException
     */
    public function makeTurnDecision(Pile $pile): ActionInterface
    {
        return $this->brain->decide($this, $pile);
    }
}