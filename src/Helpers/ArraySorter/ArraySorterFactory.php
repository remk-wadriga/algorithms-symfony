<?php

namespace App\Helpers\ArraySorter;

use App\Exception\ServiceException;
use App\Helpers\AlgorithmHelper;

class ArraySorterFactory
{
    private static $_classesMap = [
        AlgorithmHelper::TYPE_SORTING_BUBBLE => BubbleSorter::class,
        AlgorithmHelper::TYPE_SORTING_GNOME => GnomeSorter::class,
        AlgorithmHelper::TYPE_SORTING_INSERTS => InsertionSorter::class,
        AlgorithmHelper::TYPE_SORTING_SELECTION => SelectionSorter::class,
    ];

    public static function createSorter(string $type, array $array): ArraySorterInterface
    {
        $sorterClass = self::$_classesMap[$type];
        if (!is_subclass_of($sorterClass, AbstractArraySorter::class)) {
            throw new ServiceException(sprintf('Array sorter must instance of %s abstract class, but it does not. Sorter class: %s', AbstractArraySorter::class, $sorterClass), ServiceException::CODE_INVALID_CONFIG);
        }

        return new $sorterClass($array);
    }
}