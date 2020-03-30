<?php

namespace App\Service;

use App\Exception\ArraySortingException;
use App\Helpers\AlgorithmHelper;
use App\Helpers\ArrayHelper;
use App\Helpers\Sorter\Factory;
use App\Helpers\Sorter\SorterInterface;

class ArraySortingService extends AbstractService
{
    protected $defaultType = AlgorithmHelper::TYPE_SORTING_BUBBLE;

    /**
     * @param int $arraySize
     * @param string|null $type
     * @return SorterInterface
     * @throws \App\Exception\ServiceException
     */
    public function getSorter(int $arraySize = 100, string $type = null): SorterInterface
    {
        if ($type === null) {
            $type = $this->defaultType;
        }
        return Factory::createSorter($type, $this->getArray($arraySize));
    }

    public function getArray(int $length = 100, int $min = null, int $max = null): array
    {
        if ($min === null) {
            $min = -abs($length / 2);
        }
        if ($max === null) {
            $max = abs($length / 2);
        }
        $fileName = sprintf('array/random_array_%s_%s_%s.cache', $length, $min, $max);
        $fileReader = $this->getFileReader($fileName);
        if (file_exists($fileReader->getFile()->path)) {
            return $fileReader->readFile();
        } else {
            $array = ArrayHelper::generateArray($length, $min, $max);
            $fileReader->writeData($array);
            return  $array;
        }
    }
}