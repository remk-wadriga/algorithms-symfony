<?php

namespace App\Service\ArraySorters;

class InsertionSorter extends AbstractArraySorter
{
    public function sort(): ArraySorterInterface
    {
        $size = $this->getArraySize();
        $array = &$this->array;

        for ($j = 1; $j < $size; $j++) {
            $currentElement = $array[$j];
            for ($i = $j - 1; $i >= 0 && $array[$i] > $currentElement; $i--) {
                $this->iterationsCount++;
                $array[$i + 1] = $array[$i];
                $array[$i] = $currentElement;
            }
        }

        return $this;
    }
}