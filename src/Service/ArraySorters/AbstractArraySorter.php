<?php

namespace App\Service\ArraySorters;

abstract class AbstractArraySorter implements ArraySorterInterface
{
    protected $array;

    public function __construct(array &$array)
    {
        $this->array = &$array;
    }

    public function getSorted(): array
    {
        $this->sort();
        return $this->array;
    }
}