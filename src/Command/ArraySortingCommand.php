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
     *  - first param - sorting type
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
                $type = AlgorithmHelper::TYPE_SORTING_INSERTS;
                break;
            case self::TYPE_SELECTION:
                $type = AlgorithmHelper::TYPE_SORTING_SELECTION;
                break;
            default:
                $type = AlgorithmHelper::TYPE_SORTING_BUBBLE;
                break;
        }

        $size = (int)$input->getArgument('size');
        if ($size === 0) {
            $size = 10;
        }
        $sorter = $this->sorterService->getSorter($size);
        $sorted = $sorter->getSorted();
        dd(count($sorted), $sorted[0], $sorted[$size - 1]);

        return 0;
    }
}