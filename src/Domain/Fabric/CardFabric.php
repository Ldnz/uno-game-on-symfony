<?php

namespace App\Domain\Fabric;

use App\Domain\Entity\Card;

class CardFabric
{
    public static $cardColors = [
        'red',
        'yellow',
        'green',
        'blue',
    ];

    /**
     * @param string $color
     * @param int $cardNumber
     *
     * @return Card
     */
    public static function create(string $color, int $cardNumber): Card
    {
        $card = new Card();

        $card->setColor($color);
        $card->setNumber($cardNumber);

        return $card;
    }

}