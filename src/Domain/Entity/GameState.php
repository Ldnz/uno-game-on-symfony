<?php

namespace App\Domain\Entity;

class GameState
{
    /**
     * @var Card
     */
    private $topCard;

    /**
     * @var int
     */
    private $totalCardsOnPile;

    /**
     * @return Card
     */
    public function getTopCard(): Card
    {
        return $this->topCard;
    }

    /**
     * @param Card $topCard
     */
    public function setTopCard(Card $topCard): void
    {
        $this->topCard = $topCard;
    }

    /**
     * @return int
     */
    public function getTotalCardsOnPile(): int
    {
        return $this->totalCardsOnPile;
    }

    /**
     * @param int $totalCardsOnPile
     */
    public function setTotalCardsOnPile(int $totalCardsOnPile): void
    {
        $this->totalCardsOnPile = $totalCardsOnPile;
    }
}
