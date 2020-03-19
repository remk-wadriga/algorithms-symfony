<?php

namespace App\Service\ArraySorters;

interface ArraySorterInterface
{
    public function getSorted(): array;

    public function getArraySize(): int;

    public function getIterationsCount(): int;

    public function getRuntime(): int;
}