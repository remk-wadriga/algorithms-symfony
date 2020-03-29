<?php

namespace App\Helpers\ArraySorter;

class QuickSorter extends AbstractArraySorter
{
    public function sort(): ArraySorterInterface
    {
        usort($this->array, function($val1, $val2) {
            //$this->iterationsCount++;
            return $val1 > $val2 ? 1 : -1;
        });
        return $this;
    }

}