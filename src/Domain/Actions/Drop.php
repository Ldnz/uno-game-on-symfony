<?php

namespace App\Domain\Actions;

use App\Domain\Entity\Card;

class Drop extends AbstractAction implements CardHolderInterface
{
    public const NAME = 'Drop';

    /**
     * @var Card
     */
    private $hold;

    /**
     * @throws ActionNotPossibleException
     */
    public function execute(): void
    {
        if (!$this->isPossible()) {
            throw new ActionNotPossibleException();
        }

        $this->pile->append($this->hold);
        $this->player->removeCard($this->hold);
    }

    /**
     * @return bool
     */
    private function isPossible(): bool
    {
        $playerCard = $this->hold;
        $topCard = $this->pile->getTopCard();

        return $playerCard->getColor() === $topCard->getColor() || $playerCard->getNumber() === $topCard->getNumber();
    }

    /**
     * @param Card $card
     */
    public function hold(Card $card): void
    {
        $this->hold = $card;
    }
}
