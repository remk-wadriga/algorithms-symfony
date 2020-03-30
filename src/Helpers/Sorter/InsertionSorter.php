<?php

namespace App\Helpers\Sorter;

class InsertionSorter extends AbstractSorter
{
    public function sort(): SorterInterface
    {
        $size = $this->getArraySize();

        for ($j = 1; $j < $size; $j++) {
            $currentValue = $this->array[$j];
            for ($i = $j - 1; $i >= 0 && $currentValue < $this->array[$i]; $i--) {
                //$this->iterationsCount++;
                $this->array[$i + 1] = $this->array[$i];
                $this->array[$i] = $currentValue;
            }
        }

        return $this;
    }
}