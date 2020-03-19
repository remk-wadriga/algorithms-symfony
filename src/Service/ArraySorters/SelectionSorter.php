<?php

namespace App\Service\ArraySorters;

class SelectionSorter extends AbstractArraySorter
{
    public function sort(): ArraySorterInterface
    {
        return $this;
    }

}