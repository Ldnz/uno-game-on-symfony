<?php

namespace App\Domain\Entity;

use App\Domain\Actions\ActionInterface;
use App\Domain\Actions\UndefinedActionException;

abstract class Player
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
     * @param Card $card
     */
    public function addCard(Card $card): void
    {
        array_push($this->cards, $card);
    }

    /**
     * @param Card $cardToRemove
     */
    public function removeCard(Card $cardToRemove): void
    {
        foreach ($this->cards as $i => $card) {
            if ($cardToRemove->getCode() === $card->getCode()) {
                unset($this->cards[$i]);
            }
        }
    }

    /**
     * @param string $code
     *
     * @return Card|null
     */
    public function getCardByCode(string $code): ?Card
    {
        foreach ($this->cards as $card) {
            if ($card->getCode() === $code) {
                return $card;
            }
        }

        return null;
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

    /**
     * @return Card[]
     */
    public function getCardsOnHands()
    {
        return $this->cards;
    }

    /**
     * @param Pile $pile
     *
     * @return ActionInterface
     *
     * @throws UndefinedActionException
     */
    abstract public function makeTurnDecision(Pile $pile): ActionInterface;
}
