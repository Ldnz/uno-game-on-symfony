<?php

namespace App\Domain\Entity;

use App\Domain\Actions\AbstractAction;
use App\Domain\Actions\ActionInterface;
use App\Domain\Actions\CardHolderInterface;
use App\Domain\Actions\UndefinedActionException;
use App\Domain\PlayerInteraction\InteractionInterface;

class RealPlayer extends Player
{
    /**
     * @var InteractionInterface
     */
    private $interactionInterface;

    /**
     * RealPlayer constructor.
     *
     * @param InteractionInterface $interaction
     */
    public function __construct(InteractionInterface $interaction)
    {
        $this->interactionInterface = $interaction;
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
        $actionName = $this->interactionInterface->askForAction();
        $action = AbstractAction::create($actionName, $this, $pile);

        if ($action instanceof CardHolderInterface) {
            $cardCode = $this->interactionInterface->askForCard($this);
            $card = $this->getCardByCode($cardCode);

            if (null === $card) {
                throw new UndefinedActionException();
            }

            $action->hold($card);
        }

        return $action;
    }
}
