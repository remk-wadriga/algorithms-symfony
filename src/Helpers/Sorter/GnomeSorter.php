<?php


namespace App\Helpers\Sorter;


class GnomeSorter extends AbstractSorter
{
    /**
     * Алгоритм смотрит на текущий и предыдущий элементы: если они в правильном порядке,
     * он шагает на один элемент вперёд, иначе он меняет их местами и шагает на один элемент назад.
     * Граничные условия: если нет предыдущего элемента, он шагает вперёд; если нет следующего, он закончил
     *
     * @return SorterInterface
     */
    public function sort(): SorterInterface
    {
        $size = $this->getArraySize();
        $i = 1;
        $j = 2;
        while ($i < $size) {
            //$this->iterationsCount++;
            $prevIndex = $i - 1;
            if ($this->array[$prevIndex] > $this->array[$i]) {
                $currentValue = $this->array[$i];
                $this->array[$i] = $this->array[$prevIndex];
                $this->array[$prevIndex] = $currentValue;
                if (--$i == 0) {
                    $i = $j++;
                }
            } else {
                $i = $j++;
            }
        }
        return $this;
    }
}