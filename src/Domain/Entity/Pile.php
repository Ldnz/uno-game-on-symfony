<?php


namespace App\Domain\Entity;


use phpDocumentor\Reflection\Types\This;

class Pile
{
    /**
     * @var Card[]
     */
    private $cards = [];

    /**
     * @param Card $card
     */
    public function append(Card $card)
    {
        array_push($this->cards, $card);
    }

    /**
     * @return Card
     */
    public function pop(): Card
    {
        // TODO: check if pile is not empty
        $lastCard = array_pop($this->cards);

        return $lastCard;
    }

    /**
     * @return Card
     */
    public function getTopCard(): ?Card
    {
        return count($this->cards) > 0 ? $this->cards[count($this->cards) - 1] : null;
    }

    /**
     * @return int
     */
    public function getCountOfCards(): int
    {
        return count($this->cards);
    }

    public function shuffle(): void
    {
        shuffle($this->cards);
    }

}