<?php

namespace App\Helpers\File;

interface ReaderInterface
{
    public function readFile($requiredAttributes = []): array;

    public function writeData(array $data);

    public function getFile(): Entity;
}