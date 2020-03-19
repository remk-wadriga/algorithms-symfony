<?php

namespace App\Service\ArraySorters;

class InsertionSorter extends AbstractArraySorter
{
    public function sort(): ArraySorterInterface
    {
        return $this;
    }
}