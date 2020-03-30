<?php

namespace App\Command;

use App\Helpers\AlgorithmHelper;
use App\Service\SortingService;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SortingCommand extends AbstractCommand
{
    const TYPE_BUBBLE = 1;
    const TYPE_GNOME = 2;
    const TYPE_INSERTS = 3;
    const TYPE_SELECTION = 4;
    const TYPE_QUICK = 5;
    const TYPE_QUICK_STABLE = 6;

    protected static $defaultName = 'app:sort';

    protected static $algorithmsMap = [
        self::TYPE_BUBBLE => AlgorithmHelper::TYPE_SORTING_BUBBLE,
        self::TYPE_GNOME => AlgorithmHelper::TYPE_SORTING_GNOME,
        self::TYPE_INSERTS => AlgorithmHelper::TYPE_SORTING_INSERTS,
        self::TYPE_SELECTION => AlgorithmHelper::TYPE_SORTING_SELECTION,
        self::TYPE_QUICK => AlgorithmHelper::TYPE_SORTING_QUICK,
        self::TYPE_QUICK_STABLE => AlgorithmHelper::TYPE_SORTING_QUICK_STABLE,
    ];

    protected $algorithm;

    /**
     * @var SortingService
     */
    protected $sorterService;

    public function __construct(SortingService $sorterService, string $name = null)
    {
        $this->sorterService = $sorterService;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription(sprintf("Sort arrays using different algorithms.\n  Allowed modes:\n%s", $this->getModesString()))
            ->addArgument('mode', InputArgument::REQUIRED, 'Sorting mode - defines the algorithm')
            ->addArgument('size', InputArgument::REQUIRED, 'Sorted array size - defines the size of array that will be created and sorted');
    }

    /**
     * Command php bin/console app:sort 1 100
     *  - first param - sorting type (1 - "bubble", 2 - "gnome", 3 - "inserts", 4 - "selection", 5 - "quick", 6 - "quick stable")
     *  - second param - array size
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \App\Exception\ServiceException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        ini_set('memory_limit', '3G');

        $algorithm = $this->getAlgorithm($input);
        $size = $this->getSize($input);
        $sorter = $this->sorterService->getSorter($size, $algorithm);

        $output->writeln(sprintf('> Sorting %s-items array using "%s" algorithm...', $size, $algorithm));

        $sorted = $sorter->getSorted();
        //dump($sorted);

        // Bubbles.     10: 45 (0.000021), 100: 4950 (0.000511), 1000: 499499 (0.049860), 10000: 49995000 (5.009871), 100000: 4999949994 (500.853912)
        // Gnome.       10: 28 (0.000020), 100: 2271 (0.000324), 1000: 246265 (0.032683), 10000: 24776991 (3.324250), 100000: 2501400549 (330.305371)
        // Inserts.     10: 21 (0.000020), 100: 2174 (0.000232), 1000: 245271 (0.022502), 10000: 24767003 (2.247104), 100000: 2501300562 (225.239058)
        // Selection.   10: 45 (0.000019), 100: 4950 (0.000143), 1000: 499500 (0.010860), 10000: 49995000 (1.008008), 100000: 4999950000 (100.108101)
        // Quick.       10: 26 (0.000018), 100: 613 (0.000049),  1000: 9666 (0.000424),   10000: 137765 (0.005710), 100000: 1696108 (0.070662), 1000000: 21054562 (0.835028), 10000000: 246602701 (9.737353) //86, 1166
        // Quick stable.10: 32 (0.000022), 100: 624 (0.000071),  1000: 10144 (0.000612),  10000: 152743 (0.007830), 100000: 1964580 (0.097379), 1000000: 23936123 (1.257766), 10000000: 288887953 (15.793102) //96. 1168
        $output->writeln(sprintf('> Array sorted. First elem: %s, last elem: %s', $sorted[0], $sorted[$size - 1]));
        $output->writeln(sprintf('> Results of %s: %s (%s)', $size, $sorter->getIterationsCount(), $sorter->getRuntime()));
        $output->writeln(sprintf('> Used memory: %s MB', memory_get_usage(true) / 1024 / 1024));

        return 0;
    }

    protected function getAlgorithm(InputInterface $input): string
    {
        $mode = $input->getArgument('mode');
        if (!isset(self::$algorithmsMap[$mode])) {
            throw new CommandException(sprintf("Invalid sorting mode %s.\nAllowed modes:\n%s", $mode, $this->getModesString()));
        }
        return self::$algorithmsMap[$mode];
    }

    protected function getSize(InputInterface $input): int
    {
        $size = (int)$input->getArgument('size');
        if ($size <= 1) {
            throw new CommandException(sprintf("Invalid sorting array size %s.\nSize must be greater than 1", $size));
        }
        return $size;
    }

    protected function getModesString(string $sep = "\n"): string
    {
        $allowedModes = [];
        foreach (self::$algorithmsMap as $mode => $algorithm) {
            $allowedModes[] = sprintf('    %s -> "%s"', $mode, $algorithm);
        }
        return implode($sep, $allowedModes);
    }
}