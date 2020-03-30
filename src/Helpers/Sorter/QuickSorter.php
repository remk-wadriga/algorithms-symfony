<?php

namespace App\Helpers\Sorter;

class QuickSorter extends AbstractSorter
{
    public function sort(): SorterInterface
    {
        usort($this->array, function($val1, $val2) {
            //$this->iterationsCount++;
            return $val1 > $val2 ? 1 : -1;
        });
        return $this;
    }

}