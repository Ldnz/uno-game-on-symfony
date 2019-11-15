<?php

namespace App\Domain\PlayerInteraction;

use App\Domain\Actions\ActionInterface;
use App\Domain\Actions\Drop;
use App\Domain\Actions\Skip;
use App\Domain\Actions\Take;
use App\Domain\Entity\GameState;
use App\Domain\Entity\Player;
use Symfony\Component\Console\Style\SymfonyStyle;

class ConsoleInteraction implements InteractionInterface
{
    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * ConsoleInteraction constructor.
     *
     * @param SymfonyStyle $io
     */
    public function __construct(SymfonyStyle $io)
    {
        $this->io = $io;
    }

    /**
     * @param string $message
     */
    public function message(string $message): void
    {
        $this->io->writeln($message);
    }

    /**
     * @return string
     */
    public function askForAction(): string
    {
        return $this->io->choice('Choose action', [Drop::NAME, Skip::NAME, Take::NAME]);
    }

    /**
     * @param Player $player
     *
     * @return string
     */
    public function askForCard(Player $player): string
    {
        return $this->io->choice('Choose card', $player->getCardsOnHands());
    }

    /**
     * @param Player $player
     * @param GameState $state
     */
    public function beforeTurnSummary(Player $player, GameState $state): void
    {
        $this->io->writeln(sprintf(
            "%s, your turn.\n
            Top card in pile: %s,\n
            Your cards:",
            $player->getName(), $state->getTopCard()
        ));

        $cards = $player->getCardsOnHands();

        $output = '';
        foreach ($cards as $card) {
            $output .= sprintf("%s ", $card);
        }

        $this->io->writeln($output);
    }

    /**
     * @param Player $player
     * @param ActionInterface $action
     * @param GameState $state
     */
    public function afterTurnSummary(Player $player, ActionInterface $action, GameState $state): void
    {
        $this->io->writeln(sprintf(
            "Player: %s\n\r
            Top card in pile: %s,\n
            Action performed: %s\n
            Number of cards in pile: %s",
            $player->getName(), $state->getTopCard(), $action->getName(), $state->getTotalCardsOnPile()
        ));

        $this->io->writeln("---------------");
    }

    /**
     * @param Player $player
     */
    public function winnerSummary(Player $player): void
    {
        $this->io->writeln(sprintf("We have a winner! His name is %s", $player->getName()));
    }
}