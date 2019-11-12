<?php


namespace App\Domain\Fabric;

use App\Domain\Entity\Pile;

class PileFabric
{
    private const MAX_CARD_NUMBER = 9;

    /**
     * @return Pile
     */
    public static function create()
    {
        $pile = new Pile();

        foreach (CardFabric::$cardColors as $color) {
            $pile->append(CardFabric::create($color, 0));

            for ($cardNumber = 1; $cardNumber <= self::MAX_CARD_NUMBER; $cardNumber++) {
                $pile->append(CardFabric::create($color, $cardNumber));
                $pile->append(CardFabric::create($color, $cardNumber));
            }
        }

        $pile->shuffle();

        return $pile;
    }
}