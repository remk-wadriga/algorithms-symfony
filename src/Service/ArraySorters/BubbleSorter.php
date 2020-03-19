<?php

namespace App\Service\ArraySorters;

class BubbleSorter extends AbstractArraySorter
{
    /**
     * @return self
     */
    public function sort(): ArraySorterInterface
    {
        $size = $this->getArraySize();
        $array = &$this->array;

        for ($j = 0; $j < $size; $j++) {
            $isSorted = true;
            $lastIndex = $size - $j - 1;
            for ($i = 0; $i < $lastIndex; $i++) {
                $this->iterationsCount++;
                $nexIndex = $i + 1;
                if ($array[$i] >= $array[$nexIndex]) {
                    $currentElem = $array[$i];
                    $array[$i] = $array[$nexIndex];
                    $array[$nexIndex] = $currentElem;
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