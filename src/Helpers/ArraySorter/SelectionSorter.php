<?php

namespace App\Helpers\ArraySorter;

class SelectionSorter extends AbstractArraySorter
{
    public function sort(): ArraySorterInterface
    {
        $size = $this->getArraySize();

        for ($j = 0; $j < $size; $j++) {
            $minVal = $this->array[$j];
            $minValPos = $j;
            for ($i = $j + 1; $i < $size; $i++) {
                //$this->iterationsCount++;
                if ($this->array[$i] < $minVal) {
                    $minVal = $this->array[$i];
                    $minValPos = $i;
                }
            }
            if ($minValPos != $j) {
                $this->array[$minValPos] = $this->array[$j];
                $this->array[$j] = $minVal;
            }
        }

        return $this;
    }

}