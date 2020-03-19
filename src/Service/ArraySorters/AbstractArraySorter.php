<?php

namespace App\Service\ArraySorters;

abstract class AbstractArraySorter implements ArraySorterInterface
{
    protected $array;
    protected $iterationsCount = 0;
    protected $runtime = 0;

    public function __construct(array &$array)
    {
        $this->array = &$array;
    }

    abstract public function sort(): ArraySorterInterface;

    public function getSorted(): array
    {
        $startTime = microtime(true);
        $this->sort();
        $this->runtime = microtime(true) - $startTime;
        return $this->array;
    }

    public function getIterationsCount(): int
    {
        return $this->iterationsCount;
    }

    public function getRuntime(): int
    {
        return $this->runtime;
    }
}