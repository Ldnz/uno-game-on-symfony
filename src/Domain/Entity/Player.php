<?php

namespace App\Domain\Entity;

use App\Domain\Actions\ActionInterface;
use App\Domain\Actions\Drop;
use App\Domain\Actions\Skip;

class Player
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var Card[]
     */
    private $cards = [];

    /**
     * @var Card
     */
    private $cardForMove;

    /**
     * @param Card $card
     */
    public function addCard(Card $card): void
    {
        array_push($this->cards, $card);
    }

    /**
     * @return Card
     */
    public function getCardForMove(): Card
    {
        return $this->cardForMove;
    }

    /**
     * @param string $cardCode
     *
     * @return void
     */
    public function setCardForMove(string $cardCode): void
    {
        // not a good solution
        foreach ($this->cards as $i => $card) {
            if ($cardCode === $card->__toString()) {
                $this->cardForMove = clone $card;

                unset($this->cards[$i]);
            }
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCardsOnHands()
    {
        return $this->cards;
    }

}