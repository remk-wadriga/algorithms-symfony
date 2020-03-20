<?php

namespace App\Helpers\ArraySorter;

class BubbleSorter extends AbstractArraySorter
{
    /**
     * @return self
     */
    public function sort(): ArraySorterInterface
    {
        $size = $this->getArraySize();

        for ($j = 0; $j < $size; $j++) {
            $isSorted = true;
            $lastIndex = $size - $j - 1;
            for ($i = 0; $i < $lastIndex; $i++) {
                $this->iterationsCount++;
                $nexIndex = $i + 1;
                if ($this->array[$i] >= $this->array[$nexIndex]) {
                    $currentElem = $this->array[$i];
                    $this->array[$i] = $this->array[$nexIndex];
                    $this->array[$nexIndex] = $currentElem;
                    $isSorted = false;
                }
            }

            if ($isSorted) {
                break;
            }
        }

        return $this;
    }
}