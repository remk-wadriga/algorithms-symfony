<?php

namespace App\Service\ArraySorters;

interface ArraySorterInterface
{
    public function sort(): ArraySorterInterface;

    public function getSorted(): array;
}