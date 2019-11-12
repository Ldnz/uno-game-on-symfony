<?php

namespace App\Command;

use App\Domain\Actions\AbstractAction;
use App\Domain\Actions\ActionInterface;
use App\Domain\Actions\Drop;
use App\Domain\Actions\Skip;
use App\Domain\Actions\Take;
use App\Domain\Ai\AiInterface;
use App\Domain\Entity\GameState;
use App\Domain\Entity\Pile;
use App\Domain\Entity\Player;
use App\Domain\Game;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GameStartCommand extends Command
{
    /**
     * @var AiInterface
     */
    private $ai;

    protected static $defaultName = 'game:start';

    /**
     * GameStartCommand constructor.
     *
     * @param AiInterface $ai
     */
    public function __construct(AiInterface $ai)
    {
        parent::__construct();

        $this->ai = $ai;
    }

    protected function configure()
    {
        $this
            ->setDescription('Start a game!')
            ->addArgument('playerName', InputArgument::REQUIRED, 'Player Name')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $game = new Game();
        $playerName = $input->getArgument('playerName');

        $game->start($playerName);

        $bots = $game->getBots();
        $player = $game->getPlayer();
        $pile = $game->getPile();

        while (true) {
            foreach ($bots as $bot) {
                $action = $this->ai->decide($bot, $pile);
                $action->execute();

                $this->printSummary($bot, $action, $game, $io);
            }

            $this->printBeforeUserTurnSummary($player, $game->getState(), $io);

            $actionName = $io->choice('Choose action', [Drop::NAME, Skip::NAME, Take::NAME]);

            try {
                $action = AbstractAction::create($actionName, $player, $pile);

                // not a best solution
                if ($action instanceof Drop) {
                    $card = $io->choice('Choose a card', $player->getCardsOnHands());
                    $game->getPlayer()->setCardForMove($card);
                }

                $action->execute();
            } catch (\Exception $exception) {
                // TODO: customize the error message to be more acceptable for a user
                $io->writeln(sprintf("%s", $exception->getMessage()));

                return 0;
            }

            $winner = $game->checkForWinner();

            if (null !== $winner) {
                // TODO: print winner details

                break;
            }
        }

        $game->finish();

        return 0;
    }

    private function printWinnerSummary(Player $player, SymfonyStyle $io): void
    {
        $io->writeln(sprintf("We have a winner! His name is %s", $player->getName()));
    }

    private function printSummary(Player $player, ActionInterface $action, Game $game, SymfonyStyle $io): void
    {
        $state = $game->getState();

        $io->writeln(sprintf(
            "Player: %s\n\r
            Top card in pile: %s,\n
            Action performed: %s\n
            Number of cards in pile: %s",
            $player->getName(), $state->getTopCard(), $action->getName(), $state->getTotalCardsOnPile()
        ));

        $io->writeln("---------------");
    }

    private function printBeforeUserTurnSummary(Player $player, GameState $state, SymfonyStyle $io): void
    {
        $io->writeln(sprintf(
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

        $io->writeln($output);
    }
}
