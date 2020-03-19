<?php

namespace App\Service\ArraySorters;

class BubbleSorter extends AbstractArraySorter
{
    public function sort(): ArraySorterInterface
    {
        return $this;
    }
}