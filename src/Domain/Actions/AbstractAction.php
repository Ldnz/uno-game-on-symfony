<?php

namespace App\Domain\Actions;

use App\Domain\Entity\Pile;
use App\Domain\Entity\Player;

abstract class AbstractAction implements ActionInterface
{
    /**
     * @var Player
     */
    protected $player;

    /**
     * @var Pile
     */
    protected $pile;

    /**
     * AbstractAction constructor.
     *
     * @param Player $player
     * @param Pile $pile
     */
    public function __construct(Player $player, Pile $pile)
    {
        $this->player = $player;
        $this->pile = $pile;
    }

    /**
     * @param string $type
     * @param Player $player
     * @param Pile $pile
     *
     * @return mixed
     *
     * @throws UndefinedActionException
     */
    public static function create(string $type, Player $player, Pile $pile): self
    {
        switch ($type) {
            case Drop::NAME:
                $action = Drop::class;
                break;
            case  Skip::NAME:
                $action = Skip::class;
                break;
            case Take::NAME:
                $action = Take::class;
                break;
            default:
                throw new UndefinedActionException();
        }

        return new $action($player, $pile);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::class;
    }
}
