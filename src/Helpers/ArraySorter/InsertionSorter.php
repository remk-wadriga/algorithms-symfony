<?php

namespace App\Helpers\ArraySorter;

class InsertionSorter extends AbstractArraySorter
{
    public function sort(): ArraySorterInterface
    {
        $size = $this->getArraySize();

        for ($j = 1; $j < $size; $j++) {
            $currentValue = $this->array[$j];
            for ($i = $j - 1; $i >= 0 && $currentValue < $this->array[$i]; $i--) {
                $this->iterationsCount++;
                $this->array[$i + 1] = $this->array[$i];
                $this->array[$i] = $currentValue;
            }
        }

        return $this;
    }
}