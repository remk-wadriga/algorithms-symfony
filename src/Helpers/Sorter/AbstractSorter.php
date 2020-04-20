<?php

namespace App\Helpers\Sorter;

use App\Helpers\IntegerHelper;

abstract class AbstractSorter implements SorterInterface
{
    protected $array;
    protected $arraySize;
    protected $iterationsCount = 0;
    protected $runtime = 0;
    protected $usedMemory = 0;

    public function __construct(array &$array)
    {
        $this->array = $array;
    }

    abstract public function sort(): SorterInterface;

    public function getArray(): array
    {
        return  $this->array;
    }

    public function getSorted(): array
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage(true);
        $this->sort();
        $this->usedMemory -= $startMemory;
        $this->runtime = microtime(true) - $startTime;
        return $this->array;
    }

    public function getArraySize(): int
    {
        if ($this->arraySize === null) {
            $this->arraySize = count($this->array);
        }
        return $this->arraySize;
    }

    public function getIterationsCount(): int
    {
        return $this->iterationsCount;
    }

    public function getRuntime(): string
    {
        return IntegerHelper::float2string($this->runtime);
    }

    public function getUsedMemory(): string
    {
        if ($this->usedMemory <= 0) {
            $this->usedMemory = memory_get_usage(true);
        }
        return IntegerHelper::float2string($this->usedMemory / 1024 / 1024 / 1024, 2);
    }
}