<?php

namespace App\Helpers\Sorter;

class QuickSorterReplaces extends AbstractSorter
{
    public function sort(): SorterInterface
    {
        $this->sortRecursive($this->array, $this->getArraySize());
        return $this;
    }

    private function sortRecursive(array &$inputArray, int $end, int $start = 0)
    {
        $startMemory = memory_get_usage(true);
        $size = $end - $start;

        // Exit condition
        if ($size < 1) {
            return;
        }

        $baseIndex = $start + (int)($size / 2);
        $baseValue = $inputArray[$baseIndex];

        for ($i = $start; $i < $end; $i++) {
            //$this->iterationsCount++;
        	if (($i === $baseIndex && $inputArray[$i] >= $baseValue) || ($i === $baseIndex + 1 && $inputArray[$i] < $baseValue)) {
                $inputArray[$baseIndex] = $inputArray[$i];
                $inputArray[$i] = $baseValue;
                $tmpIndex = $i;
                $i = $baseIndex;
                $baseIndex = $tmpIndex;
            }

            if ($i < $baseIndex && $inputArray[$i] >= $baseValue) {
                $tmpVal = $inputArray[$baseIndex - 1];
                $inputArray[$baseIndex - 1] = $baseValue;
                $inputArray[$baseIndex--] = $inputArray[$i];
                $inputArray[$i] = $tmpVal;
                $i--;
            } elseif ($i > $baseIndex + 1 && $inputArray[$i] < $baseValue) {
                $tmpVal = $inputArray[$baseIndex + 1];
                $inputArray[$baseIndex + 1] = $baseValue;
                $inputArray[$baseIndex++] = $inputArray[$i];
                $inputArray[$i] = $tmpVal;
                $i--;
            }
        }

        $this->sortRecursive($inputArray, $baseIndex, $start);
        $this->sortRecursive($inputArray, $end, $baseIndex + 1);
        $this->usedMemory += memory_get_usage(true) - $startMemory;
    }
}