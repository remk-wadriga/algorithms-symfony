<?php

namespace App\Helpers\Sorter;

class QuickSorterArrays extends AbstractSorter
{
    public function sort(): SorterInterface
    {
        $this->sortRecursive($this->array);
        return $this;
    }

    private function sortRecursive(array &$inputArray)
    {
        $startMemory = memory_get_usage(true);
        $size = count($inputArray);

        // Exit condition
        if ($size <= 1) {
            return;
        }

        $baseValue = $inputArray[(int)($size / 2)];

        $smaller = [];
        $equal = [];
        $bigger = [];

        foreach ($inputArray as $value) {
            //$this->iterationsCount++;
            if ($value < $baseValue) {
                $smaller[] = $value;
            } elseif ($value > $baseValue) {
                $bigger[] = $value;
            } else {
                $equal[] = $value;
            }
        }

        $this->sortRecursive($smaller);
        $this->sortRecursive($bigger);

        $inputArray = array_merge($smaller, $equal, $bigger);
    }
}