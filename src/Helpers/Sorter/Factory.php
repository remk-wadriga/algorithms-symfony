<?php

namespace App\Helpers\Sorter;

use App\Exception\ServiceException;
use App\Helpers\AlgorithmHelper;

class Factory
{
    private static $_classesMap = [
        AlgorithmHelper::TYPE_SORTING_BUBBLE => BubbleSorter::class,
        AlgorithmHelper::TYPE_SORTING_GNOME => GnomeSorter::class,
        AlgorithmHelper::TYPE_SORTING_INSERTS => InsertionSorter::class,
        AlgorithmHelper::TYPE_SORTING_SELECTION => SelectionSorter::class,
        AlgorithmHelper::TYPE_SORTING_QUICK => QuickSorter::class,
        AlgorithmHelper::TYPE_SORTING_QUICK_ARRAYS => QuickSorterArrays::class,
        AlgorithmHelper::TYPE_SORTING_QUICK_REPLACES => QuickSorterReplaces::class,
    ];

    public static function createSorter(string $type, array $array): SorterInterface
    {
        $sorterClass = self::$_classesMap[$type];
        if (!is_subclass_of($sorterClass, AbstractSorter::class)) {
            throw new ServiceException(sprintf('Array sorter must instance of %s abstract class, but it does not. Sorter class: %s', AbstractSorter::class, $sorterClass), ServiceException::CODE_INVALID_CONFIG);
        }

        return new $sorterClass($array);
    }
}