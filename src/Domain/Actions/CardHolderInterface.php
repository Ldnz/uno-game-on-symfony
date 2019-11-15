<?php

namespace App\Domain\Actions;

use App\Domain\Entity\Card;

interface CardHolderInterface
{
    public function hold(Card $card): void;
}
