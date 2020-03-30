<?php

namespace App\Helpers\Sorter;

interface SorterInterface
{
    public function getSorted(): array;

    public function getArraySize(): int;

    public function getIterationsCount(): int;

    public function getRuntime(): string;
}