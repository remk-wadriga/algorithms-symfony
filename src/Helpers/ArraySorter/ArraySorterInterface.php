<?php

namespace App\Helpers\ArraySorter;

interface ArraySorterInterface
{
    public function getSorted(): array;

    public function getArraySize(): int;

    public function getIterationsCount(): int;

    public function getRuntime(): string;
}