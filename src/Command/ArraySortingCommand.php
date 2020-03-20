<?php

namespace App\Command;

use App\Helpers\AlgorithmHelper;
use App\Service\ArraySortingService;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ArraySortingCommand extends AbstractCommand
{
    const TYPE_BUBBLE = 1;
    const TYPE_INSERTS = 2;
    const TYPE_SELECTION = 3;

    protected static $defaultName = 'app:array-sort';

    protected $mode;

    /**
     * @var ArraySortingService
     */
    protected $sorterService;

    public function __construct(ArraySortingService $sorterService, string $name = null)
    {
        $this->sorterService = $sorterService;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Sort arrays using different algorithms.')
            ->addArgument('mode', InputArgument::OPTIONAL, 'Sorting mode - defines the algorithm')
            ->addArgument('size', InputArgument::OPTIONAL, 'Sorted array size - defines the size of array that will be created and sorted');
    }

    /**
     * Command php bin/console app:array-sort 1 100
     *  - first param - sorting type (1 - "bubble", 2 - "inserts", 3 - "selection")
     *  - second param - array size
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \App\Exception\ServiceException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($input->getArgument('mode')) {
            case self::TYPE_INSERTS:
                $algorithm = AlgorithmHelper::TYPE_SORTING_INSERTS;
                break;
            case self::TYPE_SELECTION:
                $algorithm = AlgorithmHelper::TYPE_SORTING_SELECTION;
                break;
            default:
                $algorithm = AlgorithmHelper::TYPE_SORTING_BUBBLE;
                break;
        }

        $size = (int)$input->getArgument('size');
        if ($size === 0) {
            $size = 10;
        }
        $sorter = $this->sorterService->getSorter($size, $algorithm);

        $output->writeln(sprintf('> Sorting %s-items array using "%s" algorithm...', $size, $algorithm));

        $sorted = $sorter->getSorted();

        // Bubbles.     10: 45 (0.000023), 100: 4950 (0.000657), 1000: 499499 (0.059985), 10000: 49995000 (6.070219), 100000: 4999949994 (627.978346)
        // Inserts.     10: 21 (0.000006), 100: 2174 (0.000276), 1000: 245271 (0.027567), 10000: 24767003 (2.739803), 100000: 2501300562 (278.207454)
        // Selection.   10: 45 (0.000020), 100: 4950 (0.000253), 1000: 499500 (0.021427), 10000: 49995000 (2.084112), 100000: 4999950000 (206.039659)
        $output->writeln(sprintf('> Array sorted. First elem: %s, last elem: %s', $sorted[0], $sorted[$size - 1]));
        $output->writeln(sprintf('> Results of %s: %s (%s)', $size, $sorter->getIterationsCount(), $sorter->getRuntime()));

        return 0;
    }
}