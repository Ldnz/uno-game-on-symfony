<?php

namespace App\Command;

use App\Domain\Ai\SkyNet;
use App\Domain\Engine;
use App\Domain\Game;
use App\Domain\GameConfig;
use App\Domain\PlayerInteraction\ConsoleInteraction;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GameStartCommand extends Command
{
    protected static $defaultName = 'game:start';

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

        $game = new Game(new GameConfig(new SkyNet(), new ConsoleInteraction($io), $input->getArgument('playerName')));

        Engine::run($game);

        return 0;
    }
}
